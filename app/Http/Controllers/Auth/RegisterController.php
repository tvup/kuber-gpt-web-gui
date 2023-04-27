<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Price;
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
use Laravel\Cashier\Subscription;
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

    public function showRegistrationForm($stripe_price_id)
    {
        $user = app(User::class);
        $intent = $user->createSetupIntent();
        $price = Price::wherePriceId($stripe_price_id)->first();
        return view('auth.register2', ['intent' => $intent, 'stripe_price_id' => $stripe_price_id, 'price' => $price]);
    }


    public function subscribe()
    {
        DB::beginTransaction();

        event(new Registered($user = $this->create(request()->all())));

        $request = request();

        try {
            $newSubscription = $user->newSubscription('default', $request->get('stripe_price_id'))->create($request->get('payment_method'));
        } catch (IncompletePayment $exception) {
            DB::rollback();
            return redirect()->back()->with(['error_message' => $exception->getMessage()]);
        }

        DB::commit();

        $this->guard()->login($user);

        $returnValue = $this->registered(request(), $user) ;
        if ($returnValue) {
            session(['status' => 'Registered']);
            return $returnValue;
        } else {
            return redirect($this->redirectPath());
        }

    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param array<string, string> $data
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
     * @param array<string, string> $data
     */
    protected function create(array $data): User
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => UserRoleEnum::User,
            'allowed_a_is' => (int)$data['allowed_a_is'],
            'a_is_running' => (int)$data['a_is_running'],
        ]);
    }
}
