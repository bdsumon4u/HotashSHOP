<?php

namespace App\Providers;

use App\Events\ProductCreated;
use App\Events\ProductUpdated;
use App\Listeners\ManageProductCategories;
use App\Listeners\ManageProductImages;
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
        ProductCreated::class => [
            ManageProductCategories::class,
            ManageProductImages::class,
        ],
        ProductUpdated::class => [
            ManageProductCategories::class,
            ManageProductImages::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
