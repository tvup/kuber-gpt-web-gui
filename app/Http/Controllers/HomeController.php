<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        //dd($user);
        if ($user->rule == 'admin') {
            $rule = 'ADMIN';
        } elseif ($user->rule == 'manager_ro') {
            $rule = 'MANAGER_RO';
        } else {
            $rule = 'USER';
        }

        return view('home')->with('rule', $rule);
    }
}
