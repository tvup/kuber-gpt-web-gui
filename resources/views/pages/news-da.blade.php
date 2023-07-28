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
                    <p>aicommits har ikke så meget at gøre med AutoGPT, men som en demonstration af, hvad AI-værktøjer kan gøre for at gøre din hverdag lettere, så tag et kig på vores commit-beskeder på GitHub:
                        <a href="https://github.com/tvup/kuber-gpt-web-gui/commits/master">tvup/kuber-gpt-web-gui</a>
                        med meget få undtagelser (f.eks. hvis commits var for store) er alle beskeder sammensat af aicommits.<br/>
                        Absolut anbefalelsesværdig: <a href="https://github.com/Nutlope/aicommits">"En CLI, der skriver dine git-commit-beskeder for dig med AI"</a>
                    <div class="font-italic lg:text-right">skrevet af Tvup, 28. april 2023</div>
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
