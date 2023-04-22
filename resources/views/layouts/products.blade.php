<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>OneUI - Bootstrap 5 Admin Template &amp; UI Framework | DEMO</title>
    <meta name="description"
          content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest | This is the demo of OneUI! You need to purchase a license for legal use! | DEMO">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">
    <meta property="og:title" content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework | DEMO">
    <meta property="og:site_name" content="OneUI">
    <meta property="og:description"
          content="OneUI - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest | This is the demo of OneUI! You need to purchase a license for legal use! | DEMO">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" href="media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/media/favicons/apple-touch-icon-180x180.png">
    <link rel="stylesheet" id="css-main" href="css/oneui.min-5.6.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
</head>
<body>
<div id="page-container"
     class="sidebar-o sidebar-dark enable-page-overlay side-scroll page-header-fixed main-content-narrow">
    <aside id="side-overlay">
        <div class="content-header border-bottom">
            <a class="img-link me-1" href="javascript:void(0)">
                <img class="img-avatar img-avatar32" src="media/avatars/avatar10.jpg" alt="">
            </a>
            <div class="ms-2">
                <a class="text-dark fw-semibold fs-sm" href="javascript:void(0)">John Smith</a>
            </div>
            <a class="ms-auto btn btn-sm btn-alt-danger" href="javascript:void(0)" data-toggle="layout"
               data-action="side_overlay_close">
                <i class="fa fa-fw fa-times"></i>
            </a>
        </div>
        <div class="content-side">
            <div class="block block-transparent pull-x pull-t">
                <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" id="so-overview-tab" data-bs-toggle="tab"
                                data-bs-target="#so-overview" role="tab" aria-controls="so-overview"
                                aria-selected="true">
                            <i class="fa fa-fw fa-coffee text-gray opacity-75 me-1"></i> Overview
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" id="so-sales-tab" data-bs-toggle="tab"
                                data-bs-target="#so-sales" role="tab" aria-controls="so-sales" aria-selected="false">
                            <i class="fa fa-fw fa-chart-line text-gray opacity-75 me-1"></i> Sales
                        </button>
                    </li>
                </ul>
                <div class="block-content tab-content overflow-hidden">
                    <div class="tab-pane pull-x fade fade-left show active" id="so-overview" role="tabpanel"
                         aria-labelledby="so-overview-tab" tabindex="0">
                        <div class="block block-transparent">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Recent Activity</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option"
                                            data-action="state_toggle" data-action-mode="demo">
                                        <i class="si si-refresh"></i>
                                    </button>
                                    <button type="button" class="btn-block-option" data-toggle="block-option"
                                            data-action="content_toggle"></button>
                                </div>
                            </div>
                            <div class="block-content">
                                <ul class="nav-items mb-0">
                                    <li>
                                        <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                            <div class="flex-shrink-0 me-3 ms-2">
                                                <i class="fa fa-fw fa-plus text-success"></i>
                                            </div>
                                            <div class="flex-grow-1 fs-sm">
                                                <div class="fw-semibold">New sale ($15)</div>
                                                <div>Admin Template</div>
                                                <small class="text-muted">3 min ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                            <div class="flex-shrink-0 me-3 ms-2">
                                                <i class="fa fa-fw fa-pencil-alt text-info"></i>
                                            </div>
                                            <div class="flex-grow-1 fs-sm">
                                                <div class="fw-semibold">You edited the file</div>
                                                <div>Documentation.doc</div>
                                                <small class="text-muted">15 min ago</small>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="text-dark d-flex py-2" href="javascript:void(0)">
                                            <div class="flex-shrink-0 me-3 ms-2">
                                                <i class="fa fa-fw fa-trash text-danger"></i>
                                            </div>
                                            <div class="flex-grow-1 fs-sm">
                                                <div class="fw-semibold">Project deleted</div>
                                                <div>Line Icon Set</div>
                                                <small class="text-muted">4 hours ago</small>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="block block-transparent">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Online Friends</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option"
                                            data-action="state_toggle" data-action-mode="demo">
                                        <i class="si si-refresh"></i>
                                    </button>
                                    <button type="button" class="btn-block-option" data-toggle="block-option"
                                            data-action="content_toggle"></button>
                                </div>
                            </div>
                            <div class="block-content">
                                <ul class="nav-items mb-0">
                                    <li>
                                        <a class="d-flex py-2" href="javascript:void(0)">
                                            <div class="me-3 ms-2 overlay-container overlay-bottom">
                                                <img class="img-avatar img-avatar48"
                                                     src="media/avatars/avatar4.jpg" alt="">
                                                <span
                                                    class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                                            </div>
                                            <div class="flex-grow-1 fs-sm">
                                                <div class="fw-semibold">Helen Jacobs</div>
                                                <div class="text-muted">Copywriter</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="d-flex py-2" href="javascript:void(0)">
                                            <div class="me-3 ms-2 overlay-container overlay-bottom">
                                                <img class="img-avatar img-avatar48"
                                                     src="media/avatars/avatar16.jpg" alt="">
                                                <span
                                                    class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                                            </div>
                                            <div class="flex-grow-1 fs-sm">
                                                <div class="fw-semibold">Brian Stevens</div>
                                                <div class="text-muted">Web Developer</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="d-flex py-2" href="javascript:void(0)">
                                            <div class="me-3 ms-2 overlay-container overlay-bottom">
                                                <img class="img-avatar img-avatar48"
                                                     src="media/avatars/avatar1.jpg" alt="">
                                                <span
                                                    class="overlay-item item item-tiny item-circle border border-2 border-white bg-success"></span>
                                            </div>
                                            <div class="flex-grow-1 fs-sm">
                                                <div class="fw-semibold">Susan Day</div>
                                                <div class="text-muted">Web Designer</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="d-flex py-2" href="javascript:void(0)">
                                            <div class="me-3 ms-2 overlay-container overlay-bottom">
                                                <img class="img-avatar img-avatar48"
                                                     src="media/avatars/avatar4.jpg" alt="">
                                                <span
                                                    class="overlay-item item item-tiny item-circle border border-2 border-white bg-warning"></span>
                                            </div>
                                            <div class="flex-grow-1 fs-sm">
                                                <div class="fw-semibold">Danielle Jones</div>
                                                <div class="text-muted">Photographer</div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="d-flex py-2" href="javascript:void(0)">
                                            <div class="me-3 ms-2 overlay-container overlay-bottom">
                                                <img class="img-avatar img-avatar48"
                                                     src="media/avatars/avatar9.jpg" alt="">
                                                <span
                                                    class="overlay-item item item-tiny item-circle border border-2 border-white bg-warning"></span>
                                            </div>
                                            <div class="flex-grow-1 fs-sm">
                                                <div class="fw-semibold">Henry Harrison</div>
                                                <div class="text-muted">Graphic Designer</div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="block block-transparent mb-0">
                            <div class="block-header block-header-default">
                                <h3 class="block-title">Quick Settings</h3>
                                <div class="block-options">
                                    <button type="button" class="btn-block-option" data-toggle="block-option"
                                            data-action="content_toggle"></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <header class="w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
        <div x-data="{ open: false }" class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
            <div class="p-4 flex flex-row items-center justify-between">
                <a href="#" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">{{__('products.kuber-gpt-ai-hassle-free')}}</a>
                <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                    <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                        <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                        <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
                <a class="px-4 py-2 mt-2 text-sm font-semibold text-gray-900 bg-gray-200 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Blog</a>
                <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Portfolio</a>
                <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">About</a>
                <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Contact</a>
                <div @click.away="open = false" class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
                        <span>Dropdown</span>
                        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #1</a>
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #2</a>
                            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="#">Link #3</a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
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
                <div class="col-md-6 col-xl-4">
                    <div class="block block-rounded h-100 mb-0">
                        <div class="block-content p-1">
                            <div class="options-container">
                                <img class="img-fluid options-item" src="media/various/ecom_product1.png" alt="">
                                <div class="options-overlay bg-black-75">
                                    <div class="options-overlay-content">
                                        <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_store_product.html">
                                            View
                                        </a>
                                        <a class="btn btn-sm btn-alt-secondary" href="{{ route('cashier.checkout-subscription') }}">
                                            <i class="fa fa-plus text-success me-1"></i> Add to cart
                                        </a>
                                        <div class="text-warning mt-3">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-alt"></i>
                                            <span class="text-white">(35)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-1">
                                <div class="fw-semibold float-end ms-1">$9</div>
                                <a class="h6" href="be_pages_ecom_store_product.html">{{__('products.bring_you_own_keys')}}</a>
                            </div>
                            <p class="fs-sm text-muted">Beautifully crafted icon set</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="block block-rounded h-100 mb-0">
                        <div class="block-content p-1">
                            <div class="options-container">
                                <img class="img-fluid options-item" src="media/various/ecom_product2.png" alt="">
                                <div class="options-overlay bg-black-75">
                                    <div class="options-overlay-content">
                                        <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_store_product.html">
                                            View
                                        </a>
                                        <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
                                            <i class="fa fa-plus text-success me-1"></i> Add to cart
                                        </a>
                                        <div class="text-warning mt-3">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <span class="text-white">(48)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-1">
                                <div class="fw-semibold float-end ms-1">$16</div>
                                <a class="h6" href="be_pages_ecom_store_product.html">{{__('products.we_have_it_all_for_you')}}</a>
                            </div>
                            <p class="fs-sm text-muted">Pro email templates</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="block block-rounded h-100 mb-0">
                        <div class="block-content p-1">
                            <div class="options-container">
                                <img class="img-fluid options-item" src="media/various/ecom_product3.png" alt="">
                                <div class="options-overlay bg-black-75">
                                    <div class="options-overlay-content">
                                        <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_store_product.html">
                                            View
                                        </a>
                                        <a class="btn btn-sm btn-alt-secondary" href="javascript:void(0)">
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
                                <div class="fw-semibold float-end ms-1">$75</div>
                                <a class="h6" href="be_pages_ecom_store_product.html">{{__('products.you_can_have_it_all')}}</a>
                            </div>
                            <p class="fs-sm text-muted">The best productivity apps</p>
                        </div>
                    </div>
                </div>
            </div>
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
    <footer>
        <div class="max-w-screen-xl px-4 py-16 mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <div>
                    <a href="#" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">{{ __('sales.kuber-gpt-ai-hassle-free') }}</a>
                    <p class="max-w-xs mt-4 text-sm text-gray-600">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, accusantium.
                    </p>
                    <div class="flex mt-8 space-x-6 text-gray-600">
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> Facebook </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clipRule="evenodd" />
                            </svg>
                        </a>
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> Instagram </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clipRule="evenodd" />
                            </svg>
                        </a>
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> Twitter </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> GitHub </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z" clipRule="evenodd" />
                            </svg>
                        </a>
                        <a class="hover:opacity-75" href target="_blank" rel="noreferrer">
                            <span class="sr-only"> Dribbble </span>
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z" clipRule="evenodd" />
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-8 lg:col-span-2 sm:grid-cols-2 lg:grid-cols-4">
                    <div>
                        <p class="font-medium">
                            Company
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-sm text-gray-500">
                            <a class="hover:opacity-75" href> About </a>
                            <a class="hover:opacity-75" href> Meet the Team </a>
                            <a class="hover:opacity-75" href> History </a>
                            <a class="hover:opacity-75" href> Careers </a>
                        </nav>
                    </div>
                    <div>
                        <p class="font-medium">
                            Services
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-sm text-gray-500">
                            <a class="hover:opacity-75" href> Company Review </a>
                            <a class="hover:opacity-75" href> Accounts Review </a>
                            <a class="hover:opacity-75" href> HR Consulting </a>
                        </nav>
                    </div>
                    <div>
                        <p class="font-medium">
                            Helpful Links
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-sm text-gray-500">
                            <a class="hover:opacity-75" href> Contact </a>
                            <a class="hover:opacity-75" href> FAQs </a>
                            <a class="hover:opacity-75" href> Live Chat </a>
                        </nav>
                    </div>
                    <div>
                        <p class="font-medium">
                            Legal
                        </p>
                        <nav class="flex flex-col mt-4 space-y-2 text-sm text-gray-500">
                            <a class="hover:opacity-75" href> Privacy Policy </a>
                            <a class="hover:opacity-75" href> Terms &amp; Conditions </a>
                            <a class="hover:opacity-75" href> Returns Policy </a>
                            <a class="hover:opacity-75" href> Accessibility </a>
                        </nav>
                    </div>
                </div>
            </div>
            <p class="mt-8 text-xs text-gray-800">
            </p>
        </div>
    </footer>
</div>
<!-- <script src="assets/js/oneui.app.min-5.6.js"></script> -->
</body>
</html>
