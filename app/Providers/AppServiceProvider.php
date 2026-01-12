<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use App\Mail\Transports\DatabaseTransport;
use Illuminate\Support\Facades\Event;
use Illuminate\Mail\Events\MessageSent;
use App\Listeners\LogSentMail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(MessageSent::class, LogSentMail::class);

        Mail::extend('db', function (array $config = []) {
            return new DatabaseTransport();
        });
    }
}
