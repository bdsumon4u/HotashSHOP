<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        $this->app->bind("pathao", function () {
            return new \App\Pathao\Manage\Manage(
                new \App\Pathao\Apis\AreaApi(),
                new \App\Pathao\Apis\StoreApi(),
                new \App\Pathao\Apis\OrderApi()
            );
        });
    }
}
