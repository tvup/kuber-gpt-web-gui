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
                        <h1 class="text-2xl mb-4">The Story</h1>
                        <h3 class="text-xl">The main idea in the company has always been to use technology to make things a little easier. It's time to create a new sense.</h3>
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
                        <h6>After having small niche businesses</h6>
                        <h2 class="text-2xl mb-4">Our journey began in 2018</h2>
                        <p>It all started with a small webshop offering products from a small basement warehouse. Automation was the focus to create a process that required a minimum of time to process orders, so the focus could be on the business itself, and costs could be kept down.</p>
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
                        <h6>Since then, the business has grown</h6>
                        <h2 class="text-2xl mb-4">From a small warehouse to over 18,000 products</h2>
                        <p>The core idea has been preserved, but the visions have grown bigger. And now we want to use our resources to offer a wide range of products at good prices.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full">
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div>
                        <h6>And we plan for more</h6>
                        <h2 class="text-2xl mb-4">We are just getting started</h2>
                        <p>In essence, there are only two states: under development or in decline. And since we lost interest in running the webshop, I am now the only one writing this chapter. But it won't be the last, and I'm sure that one day, the office will be filled with people again.</p>
                    </div>
                    <div>
                        <img class="w-full h-auto" src="{{ asset('media/images/about_01.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
    </div>




@endsection


