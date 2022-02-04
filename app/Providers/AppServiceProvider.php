<?php

namespace App\Providers;

use App\Http\Services\MainCatalogMenuManager;
use App\Models\Category;
use Illuminate\Support\Facades\Cookie;
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
        view()->composer(['front.includes.header-catalog-menu'], function ($view){
            $view->with(
                'categories',
                MainCatalogMenuManager::getMainMenu()
            );
        });


        date_default_timezone_set("Europe/Kiev");

        if (!isset($_COOKIE['app_user_id'])){
            setcookie('app_user_id', date('d-m-Y-H-i-s'). '-' . rand('1', '100000'), '0', '/');
        }


    }
}
;
