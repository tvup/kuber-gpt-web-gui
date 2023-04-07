<?php

namespace App\Http\Controllers;

use App\Certificato;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Str;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;


class CertificatoController extends Controller
{


    //necessaria autenticazione
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function delete_all() {
        $user = Auth::user();
    }


    public function read_index()
    {
        $i = 0;
        $array_contents = file(config('filesystems.key_folder'), FILE_SKIP_EMPTY_LINES);
        foreach($array_contents as $line) {
            $array_temp = explode("\t", $line);

            $date = \DateTime::createFromFormat('ymdHisZ', $array_temp[1]);
            $array_temp[1] = $date->format('d/m/Y H:i:s');
            if ($array_temp[2] != ""){
                $date = \DateTime::createFromFormat('ymdHisZ', $array_temp[2]);
                $array_temp[2] = $date->format('d/m/Y H:i:s');
            }

            //leggo il cert (mi interessa solo il nome "utente")
            $array_cert = explode("/", $array_temp[5]);
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
        Certificato::truncate();


        $i = 0;
        $array_contents = file(config('filesystems.key_file'), FILE_SKIP_EMPTY_LINES);
        foreach($array_contents as $line) {

            $certificato = new Certificato;

            $array_temp = explode("\t", $line);

            $date = \DateTime::createFromFormat('ymdHisZ', $array_temp[1]);
            $array_temp[1] = $date->format('d/m/Y H:i:s');
            $array_temp[1] = $date->format('Y-m-d H:i:s');
            if ($array_temp[2] != ""){
                $date = \DateTime::createFromFormat('ymdHisZ', $array_temp[2]);
                $array_temp[2] = $date->format('d/m/Y H:i:s');
                $array_temp[2] = $date->format('Y-m-d H:i:s');
                $certificato->dt_revoca = $array_temp[2];
            }

            //leggo il cert (mi interessa solo il nome "utente")
            $array_cert = explode("/", $array_temp[5]);
            //print_r($array_cert);
            //$array_temp[5] = $array_cert[6];
            //$array_temp[5] = substr($array_temp[5], 3);

            $array_index[$i] = $array_temp;
            $i++;

            
            $certificato->stato = $array_temp[0];
            $certificato->dt_scadenza = $array_temp[1];
            
            $certificato->idcert = $array_temp[3];
            //$certificato->cert = $array_temp[5];
            $certificato->user = $array_temp[5];
            //$certificato->link_conf = $array_temp[];
            

            //$user = \App\User::where('name','=',$certificato->user)->get();
            $user = \App\User::where('name','=',$certificato->user)->first();
           // dd($user->id);
            if(isset($user->id)) {
                //dd($user);
                $certificato->user_id = $user->id;
            }
            

            $certificato->save();

        }

        $certs =  Certificato::orderBy('id','desc')->get();
        
        
            
        //return view('home')->with('rule', $rule);
        //return view('home', ['rule' => $rule, 'array_index' => $array_index]);
        //return view('admin.readindex', ['array_index' => $array_index]);
        //return view('admin.readdb', ['certs' => $certs]);
    }



    public function popolate_db()
    {

        $this->auto_popolate_db();
        $certs =  Certificato::orderBy('id','desc')->get();
        return view('admin.readdb', ['certs' => $certs]);
    }





    public function download($cert)
    {

        $certificato = \App\Certificato::find($cert);
        $name = $certificato->user;
        $user = User::where('name',Str::remove(PHP_EOL,$name))->first();
        $tipo_vpn = $user->tipo_vpn;

        $file=config('filesystems.certificate_folder').Str::afterLast($name,'=')."_".$tipo_vpn.".ovpn";
        return \Response::download($file);

    }







    //public function revoke(Certificato $certificato, User $user)
    public function revoke($cert)
    {
        //
        // the array can contain any number of arguments and options
        ///etc/openvpn/easy-rsa/pki/script-revoke-web.sh
        //echo $cert;
        $certificato = \App\Certificato::find($cert);




        $process = new Process(array('/usr/bin/sudo', config('filesystems.script_folder').'script-revoke-web.sh', $certificato->user));
        $process->start();

        foreach ($process as $type => $data) {
            if ($process::OUT === $type) {
                echo "\nRead from stdout: ".$data;
            } else { // $process::ERR === $type
                echo "\nRead from stderr: ".$data;
            }
        }
        
        //dd($certificato->stato);
        $certificato->stato = "R";
        $certificato->save();

        $name = $certificato->user;

        $this->auto_popolate_db();

        $user = User::where('name', $name)->get()->first();
        
        $certs = Certificato::where('user',$name)->get();

        //dd($user->name);
        
        return redirect()->route('admin.admin_showuserfromname', ['name' => $user->name])->with('msg-success', 'Profile updated!');
        
    }



    //public function revoke(Certificato $certificato, User $user)
    public function release($user)
    {

        
        $user = \App\User::find($user);
        //dd($user->name);
        //controllo che l'utente non abbia certificati attivi validi
        $certificati_utente = \App\Certificato::where('user', $user->name)->get();
        //dd($certificati_utente);
        $certificati_attivi = false;
        foreach ($certificati_utente as $cert) {
            if ($cert->stato == "V") {
                $certificati_attivi = true;
            }    
        }
        //dd($certificati_attivi);
        if ($certificati_attivi == true) {
            //return view('admin.error', ['errore' => "Esitono già certificati validi per l'utente"]);
            return redirect()->back()->with('msg-danger', 'Errore: Esitono già certificati validi');
        }

        //procedo se non ha certificati validi attivi

        //$certificato = new \App\Certificato;
        

        if ($user->tipo_vpn == "FULL"){
            $process = new Process(array('/usr/bin/sudo', config('filesystems.script_folder').'build-key-pass-batch-web_FULLTCP.sh', $user->name, $user->password_clear));
        }
        else {
            $process = new Process(array('/usr/bin/sudo', config('filesystems.script_folder').'build-key-pass-batch-web_TS.sh', $user->name, $user->password_clear));
        }


        
        //dd($process);
        $process->start();

        foreach ($process as $type => $data) {
            if ($process::OUT === $type) {
                echo "\nRead from stdout: ".$data;
            } else { // $process::ERR === $type
                echo "\nRead from stderr: ".$data;
            }
        }

        $this->auto_popolate_db();

        $certs = $certificati_utente;
        //return view('admin.showuser', ['user' => $user, 'certs' => $certs]);
        //return redirect()->route('admin.admin_showuserfromname', ['name' => $user->name])->with('msg-success', 'Profile updated!');
        return redirect()->back()->with('msg-success', 'Profile updated!');
    }





    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Certificato  $certificato
     * @return \Illuminate\Http\Response
     */
    public function show(Certificato $certificato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Certificato  $certificato
     * @return \Illuminate\Http\Response
     */
    public function edit(Certificato $certificato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Certificato  $certificato
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certificato $certificato)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Certificato  $certificato
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificato $certificato)
    {
        //
    }
}
