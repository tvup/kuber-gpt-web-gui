<?php

namespace App\Http\Controllers;

use App\Enums\StatoEnum;
use App\Enums\VPNTypeEnum;
use App\Models\Certificate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    //necessaria autenticazione
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function read_index()
    {
        //Array for return
        $array_index = [];

        $i = 0;
        $array_contents = file(config('filesystems.key_folder'), FILE_SKIP_EMPTY_LINES);
        foreach ($array_contents as $line) {
            $lineItems = explode("\t", $line);

            $date = Carbon::createFromFormat('ymdHisZ', $lineItems[1]);
            $lineItems[1] = $date->format('d/m/Y H:i:s');
            if ($lineItems[2] != '') {
                $date = Carbon::createFromFormat('ymdHisZ', $lineItems[2]);
                $lineItems[2] = $date->format('d/m/Y H:i:s');
            }

            //I read the cert (I'm only interested in the "username")
            $array_cert = explode('/', $lineItems[5]);
            $lineItems[5] = $array_cert[6];
            $lineItems[5] = substr($lineItems[5], 3);

            $array_index[$i] = $lineItems;
            $i++;

        }

        return view('admin.readindex', ['array_index' => $array_index]);
    }

    public function auto_popolate_db()
    {

        Certificate::truncate();

        $i = 0;
        $array_contents = file(config('filesystems.key_file'), FILE_SKIP_EMPTY_LINES);
        foreach ($array_contents as $line) {

            $certificate = app(Certificate::class);

            //A1status/A13expiration/A13revocationA4reason/A32serial_number/A16file_name/A20distinguished_name
            $lineItems = explode("\t", $line);
            $status = $lineItems[0];
            $expiration = $lineItems[1];
            $revocationAndReason = $lineItems[2];
            $revocation = Str::substr($revocationAndReason, 0, 13);
            //$reason = Str::substr($revocationAndReason, 13);
            $serial_number = $lineItems[3];
            //$file_name = $lineItems[4];
            $distinguished_name = Str::remove(PHP_EOL, $lineItems[5]);



            $date = Carbon::createFromFormat('ymdHisZ', $expiration);
            $expiration = $date->format('Y-m-d H:i:s');
            if ($revocation != '') {
                $date = Carbon::createFromFormat('ymdHisZ', $revocation);
                $revocation = $date->format('Y-m-d H:i:s');
                $certificate->dt_revoca = $revocation;
            }

            $array_index[$i] = $lineItems;
            $i++;

            $certificate->stato = StatoEnum::to($status);
            $certificate->dt_scadenza = $expiration;

            $certificate->idcert = $serial_number;
            $certificate->cert = $distinguished_name;
            $user = User::where('user_name', '=', $distinguished_name)->firstOrNew();
            if (!$user->exists) {
                $user->user_name = $distinguished_name;
                $user->email = '';
                $user->password = '';
                $user->vat_number = '';
                $user->name = '';
                $user->surname = '';
                $user->remember_token = '';
                $user->password_clear = '';
                $user->company = '';
                $user->save();
            }

            $certificate->user()->associate($user);
            $certificate->link_conf = $lineItems;

            $certificate->save();

        }

    }

    public function popolate_db()
    {

        $this->auto_popolate_db();
        $certs = Certificate::orderBy('id', 'desc')->get();

        return view('admin.readdb', ['certs' => $certs]);
    }

    public function download($cert)
    {
        /** @var Certificate $certificate */
        $certificate = Certificate::find($cert);

        $file = sprintf('%s%s_%s.ovpn', config('filesystems.certificate_folder'), $certificate->user->strippedUserName, $certificate->user->vpn_type->value);

        return response()->download($file);

    }

    public function revoke(Certificate $certificate)
    {
        Redis::publish(config('database.redis.default.create_channel'), $certificate->user->strippedUserName);

        $certificate->stato = StatoEnum::R;
        $certificate->save();

        $this->auto_popolate_db();

        return redirect()->route('admin.admin_showuserfromname', ['name' => $certificate->user->user_name])->with('msg-success', 'Profile updated!');

    }

    public function release(User $user)
    {
        //check that the user does not have valid active certificates
        foreach ($user->certificates as $cert) {
            if ($cert->stato == StatoEnum::V) {
                return redirect()->back()->with('msg-danger', 'Error: Valid certificate(s) already exist');
            }
        }

        //I proceed if it has no active valid certificates
        if ($user->vpn_type == VPNTypeEnum::FULL) {
            Redis::publish(config('database.redis.default.create_channel'), $user->strippedUserName.' '.$user->email);
        } else {
            Redis::publish(config('database.redis.default.create_channel'), $user->strippedUserName.' '.$user->email);
        }

        return redirect()->back()->with('msg-success', 'Profile updated!');
    }
}
