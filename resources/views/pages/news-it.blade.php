@extends('layouts.frontend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/frontend.scss'])
@endsection

@section('content')
    <div class="flex bg-white" style="height:600px;">
        <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
            <div class="content-boxed border-2">
                <div class="card">
                    <h3 class="text-lg font-bold">
                        aicommits
                    </h3>
                    <p>aicommits non ha molto a che fare con AutoGPT, ma come dimostrazione di ciò che gli strumenti di intelligenza artificiale possono fare per rendere la tua quotidianità più facile, dai un'occhiata ai nostri messaggi di commit su GitHub:
                        <a href="https://github.com/tvup/kuber-gpt-web-gui/commits/master">tvup/kuber-gpt-web-gui</a>
                        con pochissime eccezioni (ad esempio, se i commit erano troppo grandi) tutti i messaggi sono composti da aicommits.<br/>
                        Assolutamente raccomandabile: <a href="https://github.com/Nutlope/aicommits">"Una CLI che scrive i tuoi messaggi di commit git per te con l'AI"</a>
                    <div class="font-italic lg:text-right">scritto da Tvup, 28 aprile 2023</div>
                </div>
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
