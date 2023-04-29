@extends('layouts.backend')

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ config('cashier.key') }}');

        stripe.redirectToCheckout({
            sessionId: '{{ $checkout_session->id }}'
        }).then(function (result) {
            console.log(result);
        });
    </script>
@endsection
