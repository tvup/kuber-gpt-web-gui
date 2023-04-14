<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(): View
    {
        $user = Auth::user();
        if ($user) {
            if ($user->role == UserRoleEnum::Admin) {
                $role = UserRoleEnum::Admin;
            } elseif ($user->role == UserRoleEnum::Manager) {
                $role = UserRoleEnum::Manager;
            } else {
                $role = UserRoleEnum::User;
            }
        } else {
            $role = UserRoleEnum::User;
        }

        return view('home')->with('role', $role);
    }

    public function approval(): View
    {
        return view('auth.approval');
    }
}
