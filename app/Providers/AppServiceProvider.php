<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Subscriptions;
use App\Observers\EventObserver;
use App\Observers\SubscriptionObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Subscriptions::observe(SubscriptionObserver::class);
        Event::observe(EventObserver::class);
    }
}
