<?php

namespace App\Providers;

use App\Models\Booking;
use App\Observers\BookingObserver;
use Illuminate\Support\Facades\View;
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
        Booking::observe(BookingObserver::class);

        View::composer('*', function($view) {
            if (auth()->guard('customer')->check()) {
                $notifications = auth()->guard('customer')->user()->watchNotifications();

                $view->with('notifications', $notifications);
                $view->with('notifications_unread', $notifications->whereNull('read_at')->count());
            }
        });
    }
}
