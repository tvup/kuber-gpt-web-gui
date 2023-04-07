<?php

namespace App\Http\Controllers;

use App\Certificato;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            //'email' => 'required|string|email|max:255|unique:users',
            'cf' => 'required|string|max:255',
            //            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$user = User::where('name', $name)->get()->first();
        $users = User::all();
        //echo($user);
        return view('admin.showallusers', ['users' => $users]);

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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id)->get();

        return view('admin.user', ['user' => $user]);

    }

    public function show_from_name($name)
    {
        //
        //dd($name);
        $user = User::where('name', $name)->get()->first();
        //echo($user);
        if (is_null($user)) {
            //dd('ok');
            return view('auth.register', ['user' => $name]);
        }

        $certs = Certificato::where('user', 'like', '%'.$name.'%')->get();

        return view('admin.showuser', ['user' => $user, 'certs' => $certs]);

    }

    public function new($name)
    {
        return view('auth.register', ['user' => $name]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);

        return view('admin.edituser', ['user' => $user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //dd($request);
        //dd($id);
        $user = User::find($id);
        $this->validator($request->all())->validate();
        $data = $request->all();
        $user->nome = $data['nome'];
        $user->cognome = $data['cognome'];
        $user->cf = $data['cf'];
        $user->societa = $data['societa'];
        $user->tipo_vpn = $data['tipo_vpn'];

        //dd($user);
        $user->save();

        //return redirect()->route('admin.admin_showallusers')->with('status', 'Profile updated!');
        //return redirect()->route('admin.admin_showallusers')->with('msg-success', 'Profile updated!');
        return redirect()->back()->with('msg-success', 'Profile updated!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function del($id)
    {
        //
        $user = User::find($id);
        //dd($user);

        $user->delete($user->id);

        return redirect()->back();
    }

    public function downloadmycert()
    {
        $user = Auth::user();
        $my_user_id = Auth::id();
        $certificato = \App\Certificato::where('user_id', $my_user_id)
            ->where('stato', 'V')
            ->firstOrFail();
        $name = $certificato->user;
        //$user = User::where('name', $name)->get()->first();
        $tipo_vpn = $user->tipo_vpn;
        //dd($user);

        $file = config('filesystems.certificate_folder').$name.'_'.$tipo_vpn.'.ovpn';

        return \Response::download($file);

    }
}
