<?php

namespace App\Providers;

use App\Services\Interfaces\ContactFormSpamCheckerInterface;
use App\Services\Mocks\ContactFormSpamCheckerMock;
use App\Services\OpenAiContactFormSpamChecker;
use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Stripe\Stripe;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('partials.language_switcher*', function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });

        view()->composer('*', function ($view) {
            $view->with('title', config('app.name', 'Laravel'));
        });

        Stripe::setApiKey(config('cashier.key'));
        Cashier::calculateTaxes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (app()->environment('production') || app()->environment('staging')) {
            $this->app->bind(ContactFormSpamCheckerInterface::class, OpenAiContactFormSpamChecker::class);
        } else {
            $this->app->bind(ContactFormSpamCheckerInterface::class, ContactFormSpamCheckerMock::class);
        }
    }
}
