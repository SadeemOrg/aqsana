<?php

namespace Acme\Projecs;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class Projecs extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */

     public static function group()
     {
         return __('Financial management');
     }
    public function boot()
    {
        Nova::script('projecs', __DIR__.'/../dist/js/tool.js');
        Nova::style('projecs', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('projecs::navigation');
    }
}
