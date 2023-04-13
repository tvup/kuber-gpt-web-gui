<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Certificate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CertificateController extends Controller
{
    //required authentication
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function auto_popolate_db(): void
    {

        Certificate::truncate();

        $i = 0;
        $fileContent = Storage::disk('pki')->get(config('filesystems.key_file'));
        if ($fileContent) {
            foreach (explode(PHP_EOL, $fileContent) as $line) {
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
                        $certificate->revoked_at = Carbon::createFromFormat('ymdHisZ', $revocation) ?: null;
                    }

                    $array_index[$i] = $lineItems;
                    $i++;

                    $certificate->status = StatusEnum::to($status);
                    $certificate->expires_at = Carbon::createFromFormat('ymdHisZ', $expiration) ?: null;

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
