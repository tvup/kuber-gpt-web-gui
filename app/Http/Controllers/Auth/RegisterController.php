<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use DB;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Checkout;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\SetupIntent;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default, this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function showRegistrationForm()
    {
//        $intent = SetupIntent::create(
//                [], Cashier::stripeOptions()
//        );
        return view('auth.register2');
    }

    public function receiveSubscriptionIntent() {
        //$this->validator(request()->all())->validate();

        return Checkout::guest()
            ->create('starter', [
                'success_url' => route('home'),
                'cancel_url' => route('home'),
            ]);


//        DB::beginTransaction();
//
//        event(new Registered($user = $this->create(request()->all())));
//
//        try {
//
//            $newSubscription = $user->newSubscription('main', 'price_1Mzq5TJsg0XlNoyeKhsP3Jqn')->create(request()->payment_method, ['line1' => 'Jernbane Alle 37', 'city' => 'Taastrup', 'postal_code'=>'2630', 'county'=>'DK','email' => $user->email]);
//        } catch ( IncompletePayment $exception ){
//            DB::rollback();
//            return redirect()->back()->with(['error_message' => $exception->getMessage()]);
//        }
//
//        DB::commit();

        $this->guard()->login($user);

        return $this->registered(request(), $user)
            ?: redirect($this->redirectPath());
    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array<string, string>  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array<string, string>  $data
     */
    protected function create(array $data): User
    {
        return User::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => UserRoleEnum::User,
        ]);
    }
}
