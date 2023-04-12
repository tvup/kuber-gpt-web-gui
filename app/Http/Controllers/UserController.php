<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users',
            'password' => 'sometimes|string|min:8|confirmed',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $users = User::all();

        return view('admin.showallusers', ['users' => $users]);

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Application|Factory|View|\Illuminate\Foundation\Application
    {
        $user = User::find($id)->get();

        return view('admin.user', ['user' => $user]);

    }

    public function show_from_name($name)
    {
        $user = User::where('user_name', Str::remove(PHP_EOL, $name))->first();
        if (null === $user) {
            return view('auth.register', ['user' => $name]);
        }
        /** @var Certificate[] $certificates */
        $certificates = Certificate::where('user', 'like', '%'.$name.'%')->get();

        return view('admin.showuser', ['user' => $user, 'certs' => $certificates]);

    }

    public function new($name)
    {
        return view('auth.register', ['user' => $name]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.edituser', ['user' => $user]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        /** @var User $user */
        $user = User::find($id);
        $this->validator($request->except('email'))->validate();
        $data = $request->all();
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->vat_number = $data['vat_number'];
        $user->company = $data['company'];
        $user->vpn_type = $data['vpn_type'];

        $user->save();

        //return redirect()->route('admin.admin_showallusers')->with('status', 'Profile updated!');
        //return redirect()->route('admin.admin_showallusers')->with('msg-success', 'Profile updated!');
        return redirect()->back()->with('msg-success', 'Profile updated!');

    }

    public function del($id)
    {
        /** @var User $user */
        $user = User::find($id);

        $user->delete();

        return redirect()->back();
    }

    public function downloadmycert()
    {
        $user = Auth::user();
        $my_user_id = Auth::id();
        /** @var Certificate $certificate */
        $certificate = Certificate::where('user_id', $my_user_id)
            ->where('stato', 'V')
            ->firstOrFail();
        $name = $certificate->user;
        //$user = User::where('name', $name)->get()->first();
        $vpn_type = $user->vpn_type;

        $file = sprintf('%s%s_%s.ovpn', config('filesystems.certificate_folder'), $name, $vpn_type);

        return \Response::download($file);

    }
}
