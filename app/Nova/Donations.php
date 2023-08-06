<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Donations extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Donations::class;
    public static function availableForNavigation(Request $request)
    {
        return false;
    }
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'donor_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','donor_name'
    ];
    public static function label()
    {
        return __('Donations');
    }
    public static function group()
    {
        return __('Donations');
    }
    public static $priority = 1;

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
            BelongsTo::make(__('project'), 'project', \App\Nova\Project::class),
            BelongsTo::make(__('user'), 'User', \App\Nova\User::class),
            Text::make(__('donor_name'), 'donor_name'),
            Text::make(__('amount'), 'amount'),
            Text::make(__('number_of_people'), 'number_of_people'),
            HasMany::make(__("ActionEvents"), "ActionEvents", \App\Nova\ActionEvents::class)

        ];
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
