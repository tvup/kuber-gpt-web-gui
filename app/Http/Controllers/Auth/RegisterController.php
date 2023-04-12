<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     */
    protected string $redirectTo = '/admin/popolate_db';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //altrimenti non esegue se sei autenticato
        //$this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user,manager_ro',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $password_clear = '';
        if ($data['role'] == UserRoleEnum::User->value) {
            $password_clear = $data['password'];
        }

        return User::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'surname' => $data['surname'],
            'vat_number' => $data['vat_number'],
            'role' => $data['role'],
            'company' => $data['company'],
            'password_clear' => $password_clear,
            'vpn_type' => $data['vpn_type'],
        ]);
    }

    /**
     * Aggiungo questo metodo - mao
     * Override default register method from RegistersUsers trait
     *
     * @return Redirector|mixed to $redirectTo
     */
    public function register(Request $request)
    {

        $this->validator($request->all())->validate();
        $user = $this->create($request->all());

        //$this->guard()->login($user);

        return $this->registered($request, $user) ?: redirect($this->redirectPath());
        //return redirect()->back()->with('message', 'Successfully created a new account.');
    }

    /**
     * Generate a unique token
     *
     * @return unique token
     */
    /*
    public function getToken() {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }
*/
    /**
     * Activate the user account
     *
     * @param  string  $key
     * @return redirect to login page
     */
    /*
    public function activation($key)
    {
        $auth_user = User::where('activation_key', $key)->first();

        if($auth_user) {
            $auth_user->status = 'active';
            $auth_user->save();
            return redirect('login')->with('success', 'Your account is activated. You can login now.');
        } else {
            return redirect('login')->with('error', 'Invalid activation key.');
        }
    }
    */

}
