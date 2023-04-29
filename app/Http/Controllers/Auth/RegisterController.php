<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use DB;
use Faker\Factory;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Cashier\Cashier;
use Laravel\Cashier\Checkout;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Charge;
use Stripe\Checkout\Session;
use Stripe\SetupIntent;
use Stripe\Stripe;

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

    public function showRegistrationForm(Request $request, $stripe_price_id)
    {
        $user = app(User::class);
        $intent = $user->createSetupIntent();
        $price = Price::wherePriceId($stripe_price_id)->first();
        if(in_array($price->type, ['tokenized', 'limited-time'])) {
            Stripe::setApiKey(config('cashier.secret'));

            // Opret en checkout session for gæsten
            $checkout_session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price' => $stripe_price_id,
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('subscribe-get').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('subscribe-get'),
            ]);

            return view('chredir')->with('checkout_session',$checkout_session);
        }
        return view('auth.register', ['intent' => $intent, 'stripe_price_id' => $stripe_price_id, 'price' => $price]);
    }


    public function subscribe()
    {
        DB::beginTransaction();

        event(new Registered($user = $this->create(request()->all())));
        if (\Illuminate\Support\Facades\Session::has('locale')) {
            $user->locale = \Illuminate\Support\Facades\Session::get('locale');
        }

        $request = request();

        try {
            $type = Price::wherePriceId($request->get('stripe_price_id'))->whereEnvironment(config('app.simulate'))->first()->type;
            if($type == 'subscription') {
                logger()->info('is subscription ' . $request->get('stripe_price_id') . ' payment method: '.$request->get('payment_method'));
                $newSubscription = $user->newSubscription('default', $request->get('stripe_price_id'))->create($request->get('payment_method'));
            } else if ($type == 'metered') {
                logger()->info('is metered ' . $request->get('stripe_price_id') . ' payment method: '.$request->get('payment_method'));
                $newSubscription = $user->newSubscription('default')->meteredPrice($request->get('stripe_price_id'))->create($request->get('payment_method'));
            } else if ($type == 'tokenized') {

            } else if ($type == 'limited-time') {

            }

        } catch (IncompletePayment $exception) {
            DB::rollback();
            return redirect()->back()->with(['error_message' => $exception->getMessage()]);
        }

        DB::commit();

        $this->guard()->login($user);
        $user->updateStripeCustomer(['name'=>$request->get('name'), 'email' => $request->get('email'), 'address'=>['city'=>$request->get('city'),'line1'=>$request->get('line1'), 'country'=>$request->get('country'),'postal_code'=>$request->get('postal_code')]]);

        $returnValue = $this->registered(request(), $user) ;
        if ($returnValue) {
            session(['status' => 'Registered']);
            return $returnValue;
        } else {
            return redirect($this->redirectPath());
        }

    }


    public function subscribeGet(Request $request)
    {
        /** @var Session $checkoutSession */
        $checkoutSession = Cashier::stripe()->checkout->sessions->retrieve($request->get('session_id'));
        /** @var User $user */
        $user = User::whereStripeId($checkoutSession->customer)->firstOrFail();
        $user->email = $checkoutSession->customer_details->email;
        $user->name = $checkoutSession->customer_details->name;
        if (\Illuminate\Support\Facades\Session::has('locale')) {
            $user->locale = \Illuminate\Support\Facades\Session::get('locale');
        }
        $user->save();


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
            'name' => 'required|string|max:255',
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
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => UserRoleEnum::User,
            'allowed_a_is' => (int)$data['allowed_a_is'],
            'a_is_running' => (int)$data['a_is_running'],
        ]);
    }
}
