<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Notification extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Notification::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    // public static function availableForNavigation(Request $request)
    // {
    //     if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("Notificationparmation",  $request->user()->userrole()) )){
    //         return true;
    //     }
    //    else return false;
    // }
    public static $title = 'id';
    public static function label()
    {
        return __('Notification');
    }
    public static function group()
    {
        return __('Notification');
    }
    public static $displayInNavigation = false  ;
    public static $priority = 1;
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];
    public static function groupOrder() {
        return 4;
    }
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__("Title"),"title"),
            Textarea::make(__("Message"),"message")->showOnIndex(),
            HasMany::make(__("ActionEvents"), "ActionEvents", \App\Nova\ActionEvents::class)

        ];
    }

    public static function afterCreate(Request $request, $model)
    {

    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
