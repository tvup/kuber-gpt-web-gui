@extends('layouts.backend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/backend.scss'])
@endsection

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
