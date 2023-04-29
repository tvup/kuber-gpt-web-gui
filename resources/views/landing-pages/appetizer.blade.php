@extends('layouts.frontend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/frontend.scss'])
@endsection

@section('content')

    <div class="flex bg-white" style="height:600px;">
        <div class="flex items-center text-center lg:text-left  md:px-12 lg:w-1/2 grid">
            <div class="disclaimer-container">
                <div class="disclaimer-box p-4 m-4 bg-yellow-300 text-2xl rounded-md">
                    <p>
                        {!! __('appetizer.disclaimer')!!}
                    </p>
                </div>
            </div>
            <div>
                <div>
                    <h2 class="mt-0 text-3xl font-semibold text-gray-800 md:text-4xl">AutoGPT <span
                            class="text-indigo-600">get ready!</span><br/> Your hosted, interactive, and self-reflective
                        AI.
                    </h2>
                    <p class="mt-2 text-sm text-gray-500 md:text-base">{{__('appetizer.its-happening-right-now-its-a-hype-and-now-if-you-want-to-to-cut-the-corners-a-see-it-for-your-self-youre-invited')}}</p>
                    <div class="flex justify-center lg:justify-start mt-6">
                        <a class="px-4 py-3 bg-gray-900 text-gray-200 text-xs font-semibold rounded hover:bg-gray-800"
                           href="{{ route('products.index') }}">{{__('appetizer.get_started')}}</a>
                        <a class="mx-4 px-4 py-3 bg-gray-300 text-gray-900 text-xs font-semibold rounded hover:bg-gray-400"
                           href="{{ route('about') }}">{{__('appetizer.learn_more')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden lg:block lg:w-1/2" style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
            <video autoplay="" muted="" loop="true" class="h-full object-cover">
                <source src="{{ asset('media/videos/demo.webm') }}#t=26,86" type="video/webm">
                <div class="h-full bg-black opacity-25 -z-10"></div>
            </video>
        </div>
    </div>
@endsection
