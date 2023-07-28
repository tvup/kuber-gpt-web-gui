@extends('layouts.frontend')

@section('title', $title)

@section('css')
    @vite(['resources/sass/frontend.scss'])
@endsection

@section('content')
    <div class="flex bg-white">
        <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">

            <article id="post-180" class="post-180 page type-page status-publish hentry">
                <!-- Content area of the page -->
                <div class="page-content">
                    <h2 class="text-2xl font-bold">Subscription Terms</h2>
                    <ol class="list-decimal list-inside ml-6">
                        <li>These terms apply to kuber-gpt.com, hereafter referred to as the "platform."</li>
                        <li>Subscribing to a plan:
                            <ol class="list-decimal list-inside ml-6">
                                <li>The subscription is created by completing an order on the website https://kuber-gpt.com, hereafter referred to as the "website."</li>
                                <li>Only payments with the following providers are accepted:
                                    <ol class="list-decimal list-inside ml-6">
                                        <li>Visa</li>
                                        <li>Mastercard</li>
                                        <li>American Express</li>
                                    </ol>
                                </li>
                                <li>The subscription continues until canceled by either party.</li>
                                <li>Each subscription period is one month, and automatic renewal will occur unless payment cannot be processed.</li>
                                <li>Prices for each product are listed on the website and include VAT.</li>
                                <li>VAT is always charged on subscriptions and other products.</li>
                            </ol>
                        </li>
                        <li>Cancellation of subscription:
                            <ol class="list-decimal list-inside ml-6">
                                <li>The provider can cancel subscriptions with one month's notice before the end of a subscription period.</li>
                                <li>The subscriber can cancel subscriptions either immediately or at the end of the next subscription period. No refunds will be provided regardless of the cancellation date.
                                    <ol class="list-decimal list-inside ml-6">
                                        <li>If the subscriber does not explicitly state whether the cancellation should be immediate or at the end of a subscription period, the latter will be applicable.</li>
                                    </ol>
                                </li>
                            </ol>
                        </li>
                        <li>Provider's obligations:
                            <ol class="list-decimal list-inside ml-6">
                                <li>The provider shall strive to keep the system available to the user 99% of the time.</li>
                                <li>Planned downtime does not count towards the above availability.</li>
                                <li>The provider cannot be held liable for any losses incurred by subscribers due to service disruptions or system errors.</li>
                            </ol>
                        </li>
                        <li>Subscriber's obligations:
                            <ol class="list-decimal list-inside ml-6">
                                <li>The subscriber must ensure that personal information such as name, address, email, and payment details are up to date.</li>
                                <li>The subscriber must be willing to receive information about system changes via email.</li>
                            </ol>
                        </li>
                        <li>Changes to terms:
                            <ol class="list-decimal list-inside ml-6">
                                <li>Changes will be notified one month in advance.</li>
                            </ol>
                        </li>
                    </ol>
                    <h2 class="text-2xl font-bold">Trading Conditions</h2>
                    <p class="font-semibold">Payment</p>
                    <p class="mb-4">Torben IT ApS accepts payment with VISA, Mastercard, and American Express.</p>
                    <p class="mb-4">All amounts are in DKK (Danish Kroner) and include VAT.</p>
                    <p class="mb-4">Torben IT ApS (CVR no. 39630605) uses an approved payment server that encrypts all your card information with SSL (Secure Socket Layer) protocol. This means that your information cannot be intercepted.</p>
                    <p class="font-semibold">Complaint options - overview and links:</p>
                    <p class="mb-4">If you have a complaint about a subscription purchased via the website, you can send a complaint to:</p>
                    <p class="mb-4">Competition and Consumer Agency's Center for Complaint Resolution<br>Carl Jacobsens Vej 35<br>2500 Valby<br>Link: <a href="http://www.forbrug.dk/" class="text-blue-500 underline">www.forbrug.dk</a></p>
                    <p class="mb-4">If you are a consumer residing in another EU country, you can submit your complaint on the EU Commission's online complaint platform.</p>
                    <p class="mb-4">The platform can be found here: <a href="http://ec.europa.eu/consumers/odr/" class="text-blue-500 underline">http://ec.europa.eu/consumers/odr/</a><br>If you submit a complaint here, you must provide our email address: contact@torbenit.dk</p>
                </div><!-- .entry-content -->
                <!-- Edit link to edit page  -->
            </article>

        </div>
        <div class="hidden lg:block lg:w-1/2" style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
            <div class="h-full object-cover"
                 style="background-image: url(https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80)">
                <div class="h-full bg-black opacity-25"></div>
            </div>
        </div>
    </div>
@endsection
