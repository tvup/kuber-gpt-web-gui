<?php

namespace App\Http\Controllers;

use App\Models\Credential;
use Illuminate\View\View;

class CredentialsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(): View
    {
        $credentials = Credential::where('user_id', auth()->user()->id)->get();

        return view('credentials.index', ['credentials' => $credentials]);
    }

}
