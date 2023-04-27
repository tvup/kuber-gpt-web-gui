@extends('layouts.landing-pages')

@section('title', $title)

@section('content')

    <div class="flex bg-white" style="height:600px;">
        <div class="content-top"  style="position:absolute;
 top:144px;
 right:-62px;
 left:205px;
 color:rgb(0, 0, 0);
 font-size:23px;
 background-color:#f6f655;
 width:586px;
 height:88px !important;
 background-position-y:0%;
 overflow:visible;
 min-height:120px;"><p>DISCLAIMER - This software is to be considered beta!<br/>A lot of these technologies are baby-new and will not work flawlessly or smoothly</p></div>
        <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
            <div>
                <h2 class="text-3xl font-semibold text-gray-800 md:text-4xl">AutoGPT <span class="text-indigo-600">get ready!</span>
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
        <div class="hidden lg:block lg:w-1/2" style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
            <div class="h-full object-cover"
                 style="background-image: url(https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80)">
                <div class="h-full bg-black opacity-25 -z-10"></div>
            </div>
        </div>
    </div>
@endsection
