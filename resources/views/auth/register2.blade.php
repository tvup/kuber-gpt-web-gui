<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
     <style>
        .alert.parsley {
    margin-top: 5px;
            margin-bottom: 0px;
            padding: 10px 15px 10px 15px;
        }
        .check .alert {
    margin-top: 20px;
        }
        .credit-card-box .panel-title {
    display: inline;
    font-weight: bold;
        }
        .credit-card-box .display-td {
    display: table-cell;
    vertical-align: middle;
            width: 100%;
        }
        .credit-card-box .display-tr {
    display: table-row;
}
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body id="app-layout">
<div class="container">
    <div class="row">
        <div class="col-md-5 offset-md-1">
            <hr>
            <h1 class="lead" style="font-size: 1.5em">Checkout</h1>
            <hr>
            <h3 class="lead" style="font-size: 1.2em; margin-bottom: 1.6em;">Billing details</h3>
            <form method="POST" action="{{route('subscribe')}}" id="reg-form">
                @csrf()
                <div class="form-group">
                    <label for="email" class="light-text">Email Address</label>
                    @guest
                        <input type="text" name="email" class="form-control my-input" required>
                    @else
                        <input type="text" name="email" class="form-control my-input" value="{{ auth()->user()->email }}" readonly required>
                    @endguest
                </div>
                <div class="form-group">
                    <label for="password" class="light-text">password</label>
                    <input type="password" name="password" class="form-control my-input" required>
                </div>
                <div class="form-group">
                    <label for="password" class="light-text">password</label>
                    <input type="password" name="password" class="form-control my-input" required>
                </div>
                <div class="form-group">
                    <label for="name" class="light-text">Name</label>
                    <input type="text" name="full_name" id="card-holder-name" class="form-control my-input" required>
                </div>
                <div class="form-group">
                    <label for="line1" class="light-text">Address</label>
                    <input type="text" name="line1" id="line1" class="form-control my-input" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="city" class="light-text">City</label>
                            <input type="text" name="city" class="form-control my-input" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="province" class="light-text">Province</label>
                        <input type="text" name="province" class="form-control my-input" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="country" class="light-text">Country</label>
                    <input type="text" name="country" class="form-control my-input" required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="postal_code" class="light-text">Postal Code</label>
                            <input type="text" name="postal_code"  id="postal_code" class="form-control my-input" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="light-text">Phone</label>
                        <input type="text" name="phone" class="form-control my-input" required>
                    </div>
                </div>
                <div id="card-element"></div>
                <button id="card-button">
                    Update Payment Method
                </button>
            </form>
        </div>
    </div>

</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{ config('cashier.key') }}');

    const elements = stripe.elements();
    const cardElement = elements.create('card', {
        hidePostalCode: true});

    cardElement.mount('#card-element');


    const cardHolderName = document.getElementById('card-holder-name');
    const cardCity = document.getElementById('city');
    const cardCountry = document.getElementById('country');
    const cardLine1 = document.getElementById('line1');
    const cardPostalCode = document.getElementById('postal_code');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {
        e.preventDefault();
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value,  address: {city: cardCity.value, country: cardCountry.value, line1: cardLine1.value, postal_code: cardPostalCode.value}}
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
</body>
</html>
