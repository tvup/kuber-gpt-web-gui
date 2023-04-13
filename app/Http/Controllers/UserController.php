<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\StreamedResponse;

class UserController extends Controller
{
    /**
     * @param  array<string, string>  $data
     */
    protected function validator(array $data): \Illuminate\Validation\Validator
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
     */
    public function index(): \Illuminate\View\View
    {
        $users = User::all();

        return view('admin.showallusers', ['users' => $users]);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): \Illuminate\View\View
    {
        return view('admin.showuser', ['user' => $user]);
    }

    public function show_from_name(string $name): \Illuminate\View\View
    {
        $user = User::where('user_name', $name)->first();
        if (null === $user) {
            return view('auth.register')->with('user_name', $name);
        }

        return view('admin.showuser', ['user' => $user, 'certs' => $user->certificates]);

    }

    public function new(string $user_name = null): \Illuminate\View\View
    {
        if ($user_name) {
            return view('auth.register')->with('user_name', $user_name);
        } else {
            return view('auth.register');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): \Illuminate\View\View
    {
        return view('admin.edituser', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $this->validator($request->except('email'))->validated();
        $data = $request->all();
        $user->name = $data['name'];
        $user->surname = $data['surname'];
        $user->vat_number = $data['vat_number'];
        $user->company = $data['company'];

        $user->save();

        return redirect()->back()->with('msg-success', 'Profile updated!');

    }

    public function del(int $id): RedirectResponse
    {
        /** @var User $user */
        $user = User::find($id);

        $user->delete();

        return redirect()->back();
    }

    public function downloadmycert(): StreamedResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $fileName = sprintf('%s.ovpn', $user->strippedUserName);

        return Storage::disk('pki')->download($fileName);

    }
}
