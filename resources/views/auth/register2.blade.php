@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 offset-md-1">
                <hr>
                <h1 class="lead" style="font-size: 1.5em">Checkout</h1>
                <hr>
                <h3 class="lead" style="font-size: 1.2em; margin-bottom: 1.6em;">Billing details</h3>
                <form method="POST" action="{{route('subscribe')}}" id="reg-form">
                    @csrf()
                    <div id="address-element"></div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="postal_code" class="light-text">Postal Code</label>
                                <input type="text" name="postal_code" id="postal_code" class="form-control my-input"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="city" class="light-text">City</label>
                                <input type="text" name="city" class="form-control my-input" required>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="email" class="light-text">Email Address</label>
                        @guest
                            <input type="text" name="email" class="form-control my-input" required>
                        @else
                            <input type="text" name="email" class="form-control my-input"
                                   value="{{ auth()->user()->email }}" readonly required>
                        @endguest
                    </div>
                    <div class="form-group">
                        <label for="password" class="light-text">Password</label>
                        <input type="password" name="password" class="form-control my-input" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="light-text">Confirm password</label>
                        <input type="password" name="password" class="form-control my-input" required>
                    </div>
                    <label for="card-element">Credit or debit card:</label><br>
                    <div id="card-element" class="form-control" style='height: 2.4em; padding-top: .7em;'></div>
                    <!-- We'll put the error messages in this element -->
                    <div id="card-errors" role="alert"></div>

                    <br>
                        <button id="card-button" class="btn btn-lg btn-primary btn-block" data-secret="{{ $intent->client_secret }}">Complete order</button>

                </form>
            </div>
            <div class="col-md-5 offset-md-1">
                <hr>
                <h3>Your Order</h3>
                <hr>
                <table class="table table-borderless table-responsive">
                    <tbody>
                        <tr>
                            <td>

                                    <img src="{{$price->img}}" height="100px" width="100px"></td>

                            <td>
                            <td>

                                    <h3 class="lead light-text">{{ $price->name }}</h3>
                                    <p class="light-text">{{ $price->name }}</p>
                                    <h3 class="light-text lead text-small">{{ $price->amount }}</h3>

                            </td>
                            <td>
                                <!-- <span class="quantity-square">1</span> -->
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <span>Total</span>
                    </div>
                    <div class="col-md-4 offset-md-4">
                        <span class="text-right" style="display: inline-block">$100</span>
                    </div>
                </div>
                <hr>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script type="module">
        const stripe = Stripe('{{ config('cashier.key') }}');

        const elements = stripe.elements();

        var style = {
            hidePostalCode: true,
            base: {
                lineHeight: '1.35',
                fontSize: "16px",
                color: '#495057',
                fontFamily: 'apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif',
                fontSmoothing: "antialiased",
                "::placeholder": {
                    color: "#32325d"
                }
            },
            invalid: {
                fontFamily: 'Arial, sans-serif',
                color: "#fa755a",
                iconColor: "#fa755a"
            },

        };
        var cardElement = elements.create("card", { style: style });

        cardElement.mount('#card-element');

        const addressElement = elements.create("address", {
            mode: "billing",
            fields: {
                city: 'always',
            },
        });
        addressElement.mount("#address-element");


        // const cardElement = elements.create('card', {
        //
        // });




        const cardHolderName = document.getElementById('card-holder-name');
        const cardCity = document.getElementById('city');
        const cardCountry = document.getElementById('country');
        const cardLine1 = document.getElementById('line1');
        const cardPostalCode = document.getElementById('postal_code');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async (e) => {
            e.preventDefault();
            const {setupIntent, error} = await stripe.confirmCardSetup(
                clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {name: cardHolderName.value,
                            address: {
                                city: cardCity.value,
                                country: cardCountry.value,
                                line1: cardLine1.value,
                                postal_code: cardPostalCode.value
                            }
                        }
                    }
                }
            );

            if (error) {
                alert('Something went wrong: ' + error);
            } else {
                document.getElementById('pmi').value = setupIntent.payment_method;
                document.getElementById("reg-form").submit();
            }
        });
    </script>
@endsection
