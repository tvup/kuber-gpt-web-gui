@extends('layouts.frontend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/frontend.scss'])
@endsection

@section('content')
    <div class="flex bg-white" style="height:600px;">
        <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
            <div>
                <p>
                    Det er ingen hemmelighed - vores software stammer fra open source - og vores software er også open source.
                </p>
                <p>Faktisk kunne du kopiere hele balladen fra GitHub og blive en konkurrerende hjemmeside.</p>
                <p>Vi udfordrer dig - gå videre :) Klik på nedenstående links</p>
                <a href="https://github.com/tvup/kuber-gpt-web-gui"> kuber-gpt-web-gui: GUI'en du oplever lige nu</a><br/>
                <a href="https://github.com/tvup/autogpt-docker"> autogpt-docker (forgaffet og kraftigt redigeret): Docker,
                    docker-compose, kubernetes, helm - alt til at køre en automatiseret opsætning</a><br/>
                <a href="https://github.com/tvup/Auto-GPT"> Auto-GPT (gaffet): Det er det hele handler om</a>
            </div>
        </div>
        <div class="hidden lg:block lg:w-1/2" style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
            <div class="h-full object-cover"
                 style="background-image: url(https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80)">
                <div class="h-full bg-black opacity-25"></div>
            </div>
        </div>
    </div>
@endsection
