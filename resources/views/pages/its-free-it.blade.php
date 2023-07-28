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
                    Non è un segreto - il nostro software deriva dall'open source - ed è anch'esso open source.
                </p>
                <p>In effetti, potresti copiare l'intero pacchetto da GitHub e diventare un sito concorrente.</p>
                <p>Ti sfidiamo - vai avanti :) Clicca sui link qui sotto</p>
                <a href="https://github.com/tvup/kuber-gpt-web-gui"> kuber-gpt-web-gui: l'interfaccia utente che stai
                    utilizzando in questo momento</a><br/>
                <a href="https://github.com/tvup/autogpt-docker"> autogpt-docker (forked and heavily edited): Docker,
                    docker-compose, kubernetes, helm - tutto il necessario per eseguire una configurazione automatizzata</a><br/>
                <a href="https://github.com/tvup/Auto-GPT"> Auto-GPT (fork): Questo è ciò di cui si tratta</a>
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
