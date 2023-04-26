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
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1 class="text-primary text-center">
          <strong>Laravel 8 Stripe Subscription</strong>
        </h1>
    </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default credit-card-box">
        <div class="panel-heading display-table" >
            <div class="row display-tr" >
                <strong>Laravel Stripe Subscription</strong>
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <form method="post" action="{{route('subscribe')}}" id="reg-form">
                    @csrf
                <label for="email">Email</label><input name="email" type="text">
                <label for="email">password</label><input name="password" type="text">
                <input type="hidden" id="pmi" name="pmi" value="">
                <input type="hidden" name="role" value="user">
                <input type="hidden" name="allowed_a_is" value="1">
                <input type="hidden" name="a_is_running" value="0">
                <label for="email">Full name</label><input name="full_name" id="card-holder-name" type="text">

                <!-- Stripe Elements Placeholder -->
                <div id="card-element"></div>

                <button id="card-button" data-secret="{{ $intent->client_secret }}">
                    Update Payment Method
                </button>
                </form>
            </div>
        </div>
    </div>

  </div>
</div>

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{ config('cashier.key') }}');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');


    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardButton.addEventListener('click', async (e) => {
        e.preventDefault();
        const { setupIntent, error } = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: { name: cardHolderName.value }
                }
            }
        );

        if (error) {
            alert('Something went wrong: ' + error);
        } else {
            document.getElementById('pmi').value = setupIntent.payment_method;
            document.getElementById("reg-form").submit();

            //window.location.replace("https://kuber-gpt.com/subscribe/" + {{ $user_id }}+ "/" + setupIntent.payment_method);
        }
    });
</script>
</body>
</html>
