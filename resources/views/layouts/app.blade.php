<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/js/app.js'])
        @vite(['resources/sass/app.scss'])
    </head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4EZJ12DDEQ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-4EZJ12DDEQ');
    </script>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            @if (Auth::user()->onTrial())
                <div class="py-3 bg-indigo-100 text-indigo-700 text-sm border-b border-indigo-200 text-center">
                    Enjoy your free trial! Don't forget to <a href="/billing" class="font-semibold underline">choose a subscription plan</a> if you like our product
                </div>
            @endif
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            {{ $slot }}

        </div>
    </body>
</html>
