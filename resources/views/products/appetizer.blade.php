@extends('layouts.products')

@section('title', $title)

@section('content')
    <main id="main-container">
        <div class="bg-image" style="background-image: url('media/photos/photo3@2x.jpg');">
            <div class="bg-primary-dark-op">
                <div class="content content-full text-center py-6">
                    <h1 class="h2 text-white mb-2">{{__('products.weve_put_it_all_together_for_you')}}</h1>
                    <h2 class="h4 fw-normal text-white-75 mb-0">{{__('products.and_weve_really_enjoyed_it_in_the_long_long_time_its_taken')}}</h2>
                    <h3>{{__('products.psst_if_you_are_the_type_who_can_also_spend_day_in_and_day_out_then_maybe_you_should_just_put_the_payment_card_away_and_click_here')}}</h3>
                </div>
            </div>
        </div>

        <div class="content content-full content-boxed">
            <h2 class="content-heading">{{__('products.choose_wisely')}}</h2>
            <div class="row items-push">
                @foreach($products as $product)
                <div class="col-xl-4">
                    <div class="block block-rounded h-100 mb-0">
                        <div class="block-content p-1">
                            <div class="options-container">
                                <img class="img-fluid options-item" src="{{$product->img}}" alt="">
                                <div class="options-overlay bg-black-75">
                                    <div class="options-overlay-content">
                                        <a class="btn btn-sm btn-alt-secondary" href="{{route('users.create', ['product_id' => $product->price_id])}}">
                                            View
                                        </a>
                                        <a class="btn btn-sm btn-alt-secondary" href="{{route('users.create', ['product_id' => $product->price_id])}}">
                                            <i class="fa fa-plus text-success me-1"></i> Add to cart
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
            <div class="text-end">
                <a class="fs-sm fw-semibold link-fx" href="be_pages_ecom_store_products.html">{{__('products.with_care')}}</a>
            </div>
        </div>
        <div class="bg-body-dark">
            <div class="content content-full">
                <div class="my-5 text-center">
                    <h3 class="h4 mb-4">
                        Over <strong>50.000</strong> digital products!
                    </h3>
                    <a class="btn btn-primary px-4 py-2" href="be_pages_ecom_store_products.html">
                        Explore Store <i class="fa fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection
