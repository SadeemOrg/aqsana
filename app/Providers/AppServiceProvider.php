<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\News;
use App\Models\Notification;
use App\Models\Project;
use App\Observers\NewsObserver;
use App\Observers\NotificationObserver;
use App\Observers\ProjectObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Debugbar', \Barryvdh\Debugbar\Facades\Debugbar::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        News::observe(NewsObserver::class);
        Project::observe(ProjectObserver::class);

        Notification::observe(NotificationObserver::class);

        View::composer(['layout.front-end.partial._header','layout.front-end.partial._Top-header-new'],
         function ($view) {
            $Navjson=nova_get_setting('Items', 'default_value');
            $nav = json_decode($Navjson);

            $view->with([
                'nav' =>  $nav
            ]);
        });

        View::composer(['layout.front-end.partial._footer'],
        function ($view) {


        $footers = nova_get_setting('Itemsfooter', 'default_value');

              $navfooters = json_decode($footers);

           $view->with([
               'navfooters' =>  $navfooters
           ]);
       });
    }
}
