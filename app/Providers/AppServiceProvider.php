<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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

        View::composer(['layout.front-end.partial._header'],
         function ($view) {
            $Navjson=nova_get_setting('Items', 'default_value');
            $nav = json_decode($Navjson);

            $view->with([
                'nav' =>  $nav
            ]);
        });
    }
}
