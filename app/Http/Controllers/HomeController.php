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

        return view('home')->with(['user' => $user, 'role' => $role]);
    }

    public function index2(): View
    {
        return view('auth.register2');
    }

    /**
     * Show the application dashboard.
     */
    public function castle(): View
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

        return view('castle')->with(['user' => $user, 'role' => $role]);
    }

    public function readMore(): View
    {
        return view('pages.read-more-'.app()->getLocale());
    }

    public function approval(): View
    {
        return view('auth.approval');
    }

    public function terms(): View
    {
        return view('pages.terms-'.app()->getLocale());
    }

    public function privacy(): View
    {
        return view('pages.privacy-'.app()->getLocale());
    }
}
