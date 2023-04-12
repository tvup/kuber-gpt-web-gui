<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class CertificateController extends Controller
{
    //necessaria autenticazione
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function delete_all()
    {
        $user = Auth::user();
    }

    public function read_index()
    {
        //Array for return
        $array_index = [];

        $i = 0;
        $array_contents = file(config('filesystems.key_folder'), FILE_SKIP_EMPTY_LINES);
        foreach ($array_contents as $line) {
            $array_temp = explode("\t", $line);

            $date = \DateTime::createFromFormat('ymdHisZ', $array_temp[1]);
            $array_temp[1] = $date->format('d/m/Y H:i:s');
            if ($array_temp[2] != '') {
                $date = \DateTime::createFromFormat('ymdHisZ', $array_temp[2]);
                $array_temp[2] = $date->format('d/m/Y H:i:s');
            }

            //leggo il cert (mi interessa solo il nome "utente")
            $array_cert = explode('/', $array_temp[5]);
            //print_r($array_cert);
            $array_temp[5] = $array_cert[6];
            $array_temp[5] = substr($array_temp[5], 3);

            $array_index[$i] = $array_temp;
            $i++;

        }

        //return view('home')->with('rule', $rule);
        //return view('home', ['rule' => $rule, 'array_index' => $array_index]);
        return view('admin.readindex', ['array_index' => $array_index]);
    }

    public function auto_popolate_db()
    {

        //DB::table('certificati')->delete();
        //cancello
        Certificate::truncate();

        $i = 0;
        $array_contents = file(config('filesystems.key_file'), FILE_SKIP_EMPTY_LINES);
        foreach ($array_contents as $line) {

            $certificate = app(Certificate::class);

            $array_temp = explode("\t", $line);

            $date = \DateTime::createFromFormat('ymdHisZ', $array_temp[1]);
            $array_temp[1] = $date->format('Y-m-d H:i:s');
            if ($array_temp[2] != '') {
                $date = \DateTime::createFromFormat('ymdHisZ', $array_temp[2]);
                $array_temp[2] = $date->format('Y-m-d H:i:s');
                $certificate->dt_revoca = $array_temp[2];
            }

            //leggo il cert (mi interessa solo il nome "utente")
            $array_cert = explode('/', $array_temp[5]);
            //print_r($array_cert);
            //$array_temp[5] = $array_cert[6];
            //$array_temp[5] = substr($array_temp[5], 3);

            $array_index[$i] = $array_temp;
            $i++;

            $certificate->stato = $array_temp[0];
            $certificate->dt_scadenza = $array_temp[1];

            $certificate->idcert = $array_temp[3];
            //$certificato->cert = $array_temp[5];
            $certificate->user = $array_temp[5];
            //$certificato->link_conf = $array_temp[];

            //$user = \App\User::where('name','=',$certificato->user)->get();
            $user = \App\Models\User::where('user_name', '=', $certificate->user)->first();
           // dd($user->id);
            if (isset($user->id)) {
                //dd($user);
                $certificate->user_id = $user->id;
            }

            $certificate->save();

        }

        $certs = Certificate::orderBy('id', 'desc')->get();

        //return view('home')->with('rule', $rule);
        //return view('home', ['rule' => $rule, 'array_index' => $array_index]);
        //return view('admin.readindex', ['array_index' => $array_index]);
        //return view('admin.readdb', ['certs' => $certs]);
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
        $name = $certificate->user;
        /** @var User $user */
        $user = User::where('user_name', Str::remove(PHP_EOL, $name))->first();
        $vpn_type = $user->vpn_type->value;

        $file = sprintf('%s%s_%s.ovpn', config('filesystems.certificate_folder'), Str::remove(PHP_EOL,Str::afterLast($name, '=')), $vpn_type);

        return response()->download($file);

    }

    public function revoke($cert)
    {
        //
        // the array can contain any number of arguments and options
        ///etc/openvpn/easy-rsa/pki/script-revoke-web.sh
        //echo $cert;
        $certificato = Certificate::find($cert);

        $process = new Process(['/usr/bin/sudo', config('filesystems.script_folder').'script-revoke-web.sh', $certificato->user]);
        $process->start();

        foreach ($process as $type => $data) {
            if ($process::OUT === $type) {
                echo "\nRead from stdout: ".$data;
            } else { // $process::ERR === $type
                echo "\nRead from stderr: ".$data;
            }
        }

        $certificato->stato = 'R';
        $certificato->save();

        $name = $certificato->user;

        $this->auto_popolate_db();

        $user = User::where('user_name', $name)->first();

        $certs = Certificate::where('user', $name)->get();

        return redirect()->route('admin.admin_showuserfromname', ['name' => $user->user_name])->with('msg-success', 'Profile updated!');

    }

    public function release($user)
    {
        $user = \App\Models\User::find($user);
        //controllo che l'utente non abbia certificati attivi validi
        $certificati_utente = \App\Models\Certificate::where('user', $user->name)->get();
        $certificati_attivi = false;
        foreach ($certificati_utente as $cert) {
            if ($cert->stato == 'V') {
                $certificati_attivi = true;
            }
        }
        if ($certificati_attivi == true) {
            return redirect()->back()->with('msg-danger', 'Errore: Esitono già certificati validi');
        }

        //procedo se non ha certificati validi attivi
        if ($user->vpn_type == 'FULL') {
            Redis::publish('my-channel', $user->name . ' ' . $user->email);
        } else {
            Redis::publish('my-channel', $user->name . ' ' . $user->email);
        }

        return redirect()->back()->with('msg-success', 'Profile updated!');
    }
}
