<?php

namespace App\Providers;

use App\Category;
use App\CategoryMenu;
use App\Menu;
use App\Setting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $parameters = optional(Route::current())
                ->parameters();
            foreach ($parameters ?: [] as $key => $value) {
                if (!$view->offsetExists($key)) {
                    $view->with($key, $value);
                }
            }
        });

        $menus = [
            'topbar-menu' => 'topbar',
            'header-menu' => 'header.menu.*',
            'quick-links' => 'footer',
        ];

        foreach ($menus as $slug => $view) {
            View::composer("partials.{$view}", function ($view) use ($slug) {
                $view->withMenuItems(cache()->rememberForever('menus:'.$slug, function () use ($slug) {
                    return optional(Menu::whereSlug($slug)->first())->menuItems ?: new Collection();
                }));
            });
        }

        View::composer('lubricant.*', function ($view) {
            $view->withMenuItems(cache()->rememberForever('menus:quick-links', function () {
                return optional(Menu::whereSlug('quick-links')->first())->menuItems ?: new Collection();
            }));
        });

        View::composer(['layouts.yellow.master',], function ($view) {
            $view->with('categories', Category::nested(10));
        });

        $settingsPages = [
            'lubricant.*',
            'partials.header.*',
            'partials.footer',
            'products.show',
            'admin.layouts.master',
            'admin.orders.show',
            'admin.orders.invoices',
            'user.layouts.master',
            'layouts.light.master',
            'layouts.yellow.master',
            'layouts.errors.master',
        ];
        View::composer($settingsPages, function ($view) {
            $view->with(Setting::array());
        });
    }
}
