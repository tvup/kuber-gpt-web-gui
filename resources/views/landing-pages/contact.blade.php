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
                    It's no secret - our software derives from open source - and our software is also open source.
                </p>
                <p>In fact, you could copy the whole chewbang from github and become a competitor site.</p>
                <p>We date you - go ahead :) Click the links below</p>
                <a href="https://github.com/tvup/kuber-gpt-web-gui"> kuber-gpt-web-gui : the GUI you're experiencing
                    right now</a><br/>
                <a href="https://github.com/tvup/autogpt-docker"> autogpt-docker (forked and heavily edited): Docker,
                    docker-compose, kubernetes, helm - everything to run an automated setup</a><br/>
                <a href="https://github.com/tvup/Auto-GPT"> Auto-GPT (fork) : This is the thing it's all about</a>
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
