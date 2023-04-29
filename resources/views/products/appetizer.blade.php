@extends('layouts.frontend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/frontend-oneui.scss'])
@endsection

@section('content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('/media/photos/photo3@2x.jpg');">
            <div class="bg-primary-dark-op">
                <div class="content content-full text-center !py-20">
                    <h1 class="h2 text-white mb-2">{{__('products/appetizer.weve_put_it_all_together_for_you')}}</h1>
                    <h2 class="h4 fw-normal text-white-75 mb-0">{{__('products/appetizer.and_weve_really_enjoyed_it_in_the_long_long_time_its_taken')}}</h2>
                </div>
                <h6 class="text-black-75 text-right"><a href="{{ route('its-free') }}">{{__('products/appetizer.psst_if_you_are_the_type_who_can_also_spend_day_in_and_day_out_then_maybe_you_should_just_put_the_payment_card_away_and_click_here')}}</a></h6>
            </div>

        </div>

        <div class="content content-full content-boxed">
            <h2 class="content-heading">{{__('products/appetizer.choose_wisely')}}</h2>
            <div class="row items-push">
                @foreach($products as $product)
                <div class="col-xl-4">
                    <div class="block block-rounded h-100 mb-0">
                        <div class="block-content p-1">
                            <div class="options-container">
                                <img class="img-fluid options-item" src="{{$product->img}}" alt="">
                                <div class="options-overlay bg-black-75">
                                    <div class="options-overlay-content">
                                        <a class="!bg-slate-100 btn btn-sm btn-alt-secondary" href="{{route('users.create', ['product_id' => $product->price_id])}}">
                                            <i class="fa fa-plus text-success me-1"></i> Sign up and checkout
                                        </a>
                                        <div class="text-warning mt-3">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-alt"></i>
                                            <span class="text-white">(19)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-1">
                                <div class="fw-semibold float-end ms-1">€ {{$product->amount}}</div>

                                <a class="h6" href="{{route('users.create', ['product_id' => $product->price_id])}}">{{ $product->name }}</a>
                            </div>
                            @forelse($product->tag_lines as $line)
                                <p class="fs-sm text-muted">{{$line}}</p>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-end">
                {{__('products/appetizer.with_care')}}
            </div>
        </div>

    </main>
@endsection
