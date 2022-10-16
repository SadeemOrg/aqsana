<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Budget extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Budget::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

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
            Text::make(__('year'), 'year'),

            Text::make(__('humanitarian_sector'), 'humanitarian_sector')->hideFromIndex(),
            Text::make(__('humanitarian_sector'), function () {
                return 'ddd';
            })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),

            Text::make(__('health_sector'), 'health_sector')->hideFromIndex(),
            Text::make(__('humanitarian_sector'), function () {
                return 'ddd';
            })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),

            Text::make(__('educational_sector'), 'educational_sector')->hideFromIndex(),
            Text::make(__('humanitarian_sector'), function () {
                return 'ddd';
            })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),

            Text::make(__('economic_sector'), 'economic_sector')->hideFromIndex(),
            Text::make(__('humanitarian_sector'), function () {
                return 'ddd';
            })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),

            Text::make(__('al_aqsa_sector'), 'al_aqsa_sector')->hideFromIndex(),
            Text::make(__('humanitarian_sector'), function () {
                return 'ddd';
            })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),

            Text::make(__('sanctuaries_sector'), 'sanctuaries_sector')->hideFromIndex(),
            Text::make(__('humanitarian_sector'), function () {
                return 'ddd';
            })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),

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
