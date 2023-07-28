@extends('layouts.frontend')

@section('title', 'Historien')

@section('css')
    @vite(['resources/sass/frontend.scss'])
@endsection

@section('content')
    <div class="flex flex-wrap">
        <section class="w-full">
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <h1 class="text-2xl mb-4">Historien</h1>
                        <h3 class="text-xl">Kongstanken i virksomheden, har altid været at bruge teknologien til at gøre tingene lidt nemmere. Det er tid til at skabe en ny følelse.</h3>
                    </div>
                    <div>
                        <!-- Empty div -->
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full">
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <h6>Efter at have haft små nichevirksomheder</h6>
                        <h2 class="text-2xl mb-4">Vores rejse begyndte i 2018</h2>
                        <p>Det hele begyndte med en lille webshop, der tilbød varer fra et lille kælderlager. Automatiseringen var i fokus for at skabe en proces, der krævede et minimum af tid at behandle ordrer, så fokus kunne være på selve forretningen og omkostningerne holdes nede.</p>
                    </div>
                    <div>
                        <img class="w-full h-auto" src="{{ asset('media/images/about_03.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full">
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <img class="w-full h-auto" src="{{ asset('media/images/about_02.jpg') }}" alt="">
                    </div>
                    <div>
                        <h6>Siden er forretningen vokset</h6>
                        <h2 class="text-2xl mb-4">Fra lille lager til over 18.000 varer</h2>
                        <p>Grundtanken er bevaret, men visionerne er blevet større. Og nu vil vi bruge ressourcerne på at kunne tilbyde et bredt udvalg af varer til gode priser.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full">
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <h6>Og vi planlægger med mere</h6>
                        <h2 class="text-2xl mb-4">Vi er kun lige begyndt</h2>
                        <p>I bund og grund kan man kun være i to tilstande: Under udvikling eller under afvikling. Og da vi mistede lysten til at drive webshop, så er jeg nu ene mand om at skrive dette kapitel. Men det bliver ikke det sidste, og jeg er sikker på, at en dag, så bliver kontoret fyldt med folk igen. </p>
                    </div>
                    <div>
                        <img class="w-full h-auto" src="{{ asset('media/images/about_01.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
    </div>



@endsection


