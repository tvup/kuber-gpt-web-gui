<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users',
            'password' => 'sometimes|string|min:8|confirmed',
            'role' => 'sometimes|in:admin,user,manager_ro',
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
    public function show(User $user): Application|Factory|View|\Illuminate\Foundation\Application
    {
        return view('admin.showuser', ['user' => $user]);
    }

    public function show_from_name($name)
    {
        $user = User::where('user_name', $name)->first();
        if (null === $user) {
            return view('auth.register', ['user' => $name]);
        }

        return view('admin.showuser', ['user' => $user, 'certs' => $user->certificates]);

    }

    public function new($user_name)
    {
        return view('auth.register', ['user_name' => $user_name]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function edit(User $user)
    {
        return view('admin.edituser', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return RedirectResponse
     */
    public function update(Request $request, User $user)
    {
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

        $file = sprintf('%s%s_%s.ovpn', config('filesystems.certificate_folder'), $user->strippedUserName, $user->vpn_type->value);

        return response()->download($file);

    }
}
