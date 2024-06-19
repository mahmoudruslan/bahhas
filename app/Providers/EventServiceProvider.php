<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        // ArbPaymentSuccessEvent::class => [
        //     LogSuccessArbPaymentListener::class, // add any listener classes you want to handle the success payment
        // ],
        // ArbPaymentFailedEvent::class => [
        //     LogFailedArbPaymentListener::class, // add any listener classes you want to handle the failed payment
        // ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
