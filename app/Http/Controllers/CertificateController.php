<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Certificate;
use App\Models\User;
use Carbon\Carbon;
use ErrorException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CertificateController extends Controller
{
    //required authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read_index(): View
    {
        //Array for return
        $array_index = [];

        $i = 0;
        $files = Storage::disk('pki')->files();

        foreach ($files as $file) {
            try {
                $array_contents = File::get(config('filesystems.key_folder').$file);
            } catch (ErrorException $e) {
                continue;
            }
            foreach (explode(PHP_EOL, $array_contents) as $line) {
                $lineItems = explode("\t", $line);

                try {
                    $date = Carbon::createFromFormat('ymdHisZ', array_key_exists(1, $lineItems) ? $lineItems[1] : Carbon::now('Europe/Copenhagen')->format('ymdHisZ'));
                } catch (InvalidArgumentException $e) {
                    $date = Carbon::now('Europe/Copenhagen');
                }

                $lineItems[1] = $date->format('d/m/Y H:i:s');
                if (array_key_exists(2, $lineItems) && $lineItems[2] != '') {
                    try {
                        $date = Carbon::createFromFormat('ymdHisZ', $lineItems[2]);
                    } catch (InvalidArgumentException $e) { /** @phpstan-ignore-line */
                        $date = Carbon::now('Europe/Copenhagen');
                    }
                    $lineItems[2] = $date->format('d/m/Y H:i:s');
                }

                //I read the cert (I'm only interested in the "username")
                $array_cert = explode('/', array_key_exists(5, $lineItems) ? $lineItems[5] : '');
                $lineItems[5] = array_key_exists(6, $array_cert) ? $array_cert[6] : '    ';
                $lineItems[5] = substr($lineItems[5], 3);

                $array_index[$i] = $lineItems;
                $i++;

            }
        }

        return view('admin.readindex', ['array_index' => $array_index]);
    }

    public function auto_popolate_db(): void
    {

        Certificate::truncate();

        $i = 0;
        foreach (explode(PHP_EOL, Storage::disk('pki')->get(config('filesystems.key_file'))) as $line) {
            $certificate = app(Certificate::class);

            //A1status/A13expiration/A13revocationA4reason/A32serial_number/A16file_name/A20distinguished_name
            $lineItems = explode("\t", $line);
            if (count($lineItems) >= 6) {
                $status = $lineItems[0];
                $expiration = $lineItems[1];
                $revocationAndReason = $lineItems[2];
                $revocation = Str::substr($revocationAndReason, 0, 13);
                //$reason = Str::substr($revocationAndReason, 13);
                $serial_number = $lineItems[3];
                //$file_name = $lineItems[4];
                $distinguished_name = Str::remove(PHP_EOL, $lineItems[5]);

                if ($revocation != '') {
                    $certificate->revoked_at = Carbon::createFromFormat('ymdHisZ', $revocation);
                }

                $array_index[$i] = $lineItems;
                $i++;

                $certificate->status = StatusEnum::to($status);
                $certificate->expires_at = Carbon::createFromFormat('ymdHisZ', $expiration);

                $certificate->idcert = $serial_number;
                $certificate->cert = $distinguished_name;
                $user = User::where('user_name', '=', $distinguished_name)->first();

                if ($user) {
                    $certificate->user()->associate($user);
                }
                $certificate->link_conf = $lineItems;

                $certificate->save();
            }

        }

    }

    public function popolate_db(): View
    {

        $this->auto_popolate_db();
        $certificates = Certificate::orderBy('id', 'desc')->get();

        return view('admin.readdb', ['certificates' => $certificates]);
    }

    public function download(Certificate $certificate): StreamedResponse
    {
        $fileName = sprintf('%s.ovpn', $certificate->strippedUserName);

        return Storage::disk('pki')->download($fileName);

    }

    public function revoke(Certificate $certificate): RedirectResponse
    {
        Redis::publish(config('database.redis.default.revoke_channel'), $certificate->user->strippedUserName);

        $certificate->status = StatusEnum::R;
        $certificate->save();

        $this->auto_popolate_db();

        return redirect()->route('admin.admin_showuserfromname', ['name' => $certificate->user->user_name])->with('msg-success', 'Profile updated!');

    }

    public function release(User $user): RedirectResponse
    {
        //check that the user does not have valid active certificates
        foreach ($user->certificates as $cert) {
            if ($cert->status == StatusEnum::V) {
                return redirect()->back()->with('msg-danger', 'Error: Valid certificate(s) already exist');
            }
        }

        //I proceed if it has no active valid certificates
        Redis::publish(config('database.redis.default.create_channel'), $user->strippedUserName.' '.$user->email);

        return redirect()->back()->with('msg-success', 'Profile updated!');
    }
}
