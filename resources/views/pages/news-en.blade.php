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
                    <p>aicommits hasn't got that much to do with AutoGPT, but as a demostration of what AI-tools can do
                        to
                        make your every-day easier, take a look at our commit messages at github:
                        <a href="https://github.com/tvup/kuber-gpt-web-gui/commits/master">tvup/kuber-gpt-web-gui</a>
                        with a very few exceptions (e.g. if commits were to large) all messages are composed by
                        aicommits.<br/>
                        Surely recommendable: <a href="https://github.com/Nutlope/aicommits">"A CLI that writes your git
                            commit messages for you with AI"</a>
                    <div class="font-italic lg:text-right">written by Tvup, april 28th, 2023</div>
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
