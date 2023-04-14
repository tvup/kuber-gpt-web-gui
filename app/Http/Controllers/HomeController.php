<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index()
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

    public function approval()
    {
        return view('approval');
    }
}
