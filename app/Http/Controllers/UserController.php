<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Carbon\Carbon;
use Exception;
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
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users',
            'password' => 'sometimes|string|min:8|confirmed',
            'role' => 'sometimes|in:admin,user,manager_ro',
            'allowed_a_is' => 'required|int',
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

    public function create(string $name = null): View
    {
        if ($name) {
            return view('admin.users.create')->with('name', $name);
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

    public function showByUserName(string $name): View
    {
        $user = User::where('name', $name)->first();
        if (null === $user) {
            return view('admin.users.create')->with('name', $name);
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

        $user = User::create([
            'name' => $data['name'] . ' ' . $data['surname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'vat_number' => $data['vat_number'],
            'role' => $data['role'],
            'company' => $data['company'],
            'password_clear' => $password_clear,
            'allowed_a_is' => $data['allowed_a_is'],
            'a_is_running' => 0,
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
        $user->name = $data['name'] . ' ' . $data['surname'];
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

    public function toggleAccess(string $id): View
    {
        $user = User::find($id);
        if (!$user) {
            throw new Exception('User not found with id: ' . $id);
        }
        if ($user->approved_at) {
            $user->approved_at = null;
            $text = 'User deactivated!';
        } else {
            $user->approved_at = Carbon::now('Europe/Copenhagen');
            $text = 'User activated!';
        }
        $user->save();

        return view('admin.users.edit', ['user' => $user])->with('msg-success', $text);
    }
}
