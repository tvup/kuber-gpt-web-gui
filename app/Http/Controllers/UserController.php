<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
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
    public function index(): View
    {
        $users = User::all();

        return view('admin.users.index', ['users' => $users]);

    }

    public function create(string $user_name = null): View
    {
        if ($user_name) {
            return view('admin.users.create')->with('user_name', $user_name);
        } else {
            return view('admin.users.create');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('admin.users.show', ['user' => $user]);
    }

    public function showByUserName(string $user_name): View
    {
        $user = User::where('user_name', $user_name)->first();
        if (null === $user) {
            return view('admin.users.create')->with('user_name', $user_name);
        }

        return view('admin.users.show', ['user' => $user]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validator($request->except('email'))->validated();
        $data = $request->all();

        $password_clear = '';
        if ($data['role'] == UserRoleEnum::User->value) {
            $password_clear = $data['password'];
        }

        User::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'surname' => $data['surname'],
            'vat_number' => $data['vat_number'],
            'role' => $data['role'],
            'company' => $data['company'],
            'password_clear' => $password_clear,
        ]);

        return redirect()->route('admin.users.index')->with('msg-success', 'User created!');
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

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('msg-danger', 'User deleted!');
    }

    /** User functions **/
    public function downloadUserCert(): StreamedResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $fileName = sprintf('%s.ovpn', $user->strippedUserName);

        return Storage::disk('pki')->download($fileName);

    }
}
