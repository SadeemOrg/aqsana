<?php

namespace Acme\Bill;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class Bill extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public $meta;
    public function boot()
    {
        Nova::script('bill', __DIR__.'/../dist/js/tool.js');
        Nova::style('bill', __DIR__.'/../dist/css/tool.css');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('bill::navigation', [
            'value' => request()->route('value')
        ]);
    }
    public function withMeta(array $meta)
    {
        $this->meta = array_merge($this->meta ?? [], $meta);

        return $this;
    }

    public function route($uri, $callback)
    {
        // Your code here
    }
}
