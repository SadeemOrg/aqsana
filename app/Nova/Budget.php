<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Eminiarts\Tabs\Traits\HasTabs;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\Tab;
use Laravel\Nova\Fields\Number;
use Ngiraud\FormHeader\FormHeader;
use Laravel\Nova\Panel;

class Budget extends Resource
{
    // use InteractsWithMedia;
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


    public static function label()
    {
        return __('Budget');
    }
    public static function group()
    {
        return __('Financial management');
    }
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


            Tabs::make('Some Title', [
                Tab::make(__('humanitarian sector'), [

                    Text::make(__('humanitarian sector budjet'), 'humanitarian_sector')->hideFromIndex(),
                    Text::make(__('income of the humanitarian sector'), function () {
                        // $income =
                        return 'income';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                    Text::make(__('humanitarian sector expenditures'), function () {
                        return 'expenditures';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                    Text::make(__('net budget'), function () {
                        return 'net budget';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                ]),
                Tab::make(__('health sector'), [
                    Text::make(__('health sector budjet'), 'health_sector')->hideFromIndex(),
                    Text::make(__('income of the health sector'), function () {
                        return 'ddd';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                    Text::make(__('health sector expenditures'), function () {
                        return 'ddd';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                    Text::make(__('net budget'), function () {
                        return 'net budget';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                ]),
                Tab::make(__('educational sector'), [
                    Text::make(__('educational sector budjet'), 'educational_sector')->hideFromIndex(),
                    Text::make(__('income of the educational sector'), function () {
                        return 'ddd';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                    Text::make(__('educational sector expenditures'), function () {
                        return 'ddd';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                    Text::make(__('net budget'), function () {
                        return 'net budget';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                ]),
                Tab::make(__('economic sector'), [

                    Text::make(__('economic sector budjet'), 'economic_sector')->hideFromIndex(),
                    Text::make(__('income of the economic sector'), function () {
                        return 'ddd';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                    Text::make(__('economic sector expenditures'), function () {
                        return 'ddd';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                    Text::make(__('net budget'), function () {
                        return 'net budget';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),

                ]),
                Tab::make(__('al_aqsa sector'), [
                    Text::make(__('al_aqsa sector budjet'), 'al_aqsa_sector')->hideFromIndex(),
                    Text::make(__('income of the al_aqsa sector'), function () {
                        return 'ddd';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                    Text::make(__('al_aqsa sector expenditures'), function () {
                        return 'ddd';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                    Text::make(__('net budget'), function () {
                        return 'net budget';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                ]),
                Tab::make(__('sanctuaries sector'), [
                    Text::make(__('sanctuaries sector budjet'), 'sanctuaries_sector')->hideFromIndex(),
                    Text::make(__('income of the sanctuaries sector'), function () {
                        return 'ddd';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                    Text::make(__('sanctuaries sector expenditures'), function () {
                        return 'ddd';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                    Text::make(__('net budget'), function () {
                        return 'net budget';
                    })->hideFromIndex()->hideWhenCreating()->hideWhenUpdating(),
                ]),
            ]),



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
