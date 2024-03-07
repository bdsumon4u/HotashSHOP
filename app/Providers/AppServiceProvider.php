<?php

namespace App\Providers;

use App\Extensions\DatabaseSessionHandler;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
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

        Session::extend('custom', function ($app) {
            $table = $app['config']['session.table'];
            $lifetime = $app['config']['session.lifetime'];
            $connection = $app['db']->connection($app['config']['session.connection']);

            return new DatabaseSessionHandler($connection, $table, $lifetime, $app);
        });

        Builder::macro(
            'withWhereHas',
            function ($relation, $constraint) {
                return $this
                    ->whereHas($relation, $constraint)
                    ->with([$relation => $constraint]);
            }
        );

        $this->app->bind("pathao", function () {
            return new \App\Pathao\Manage\Manage(
                new \App\Pathao\Apis\AreaApi(),
                new \App\Pathao\Apis\StoreApi(),
                new \App\Pathao\Apis\OrderApi()
            );
        });
    }
}
