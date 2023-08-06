<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Flexible;
use Acme\MultiselectField\Multiselect;
use App\Models\VolunteersProjects;

class volunteersHower extends Resource
{



    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\volunteersHower::class;
    public static function label()
    {
        return __('volunteersHower');
    }
    public static function group()
    {
        return __('VolunteersE');
    }
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    public static function groupOrder() {
        return 6 ;
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'phone_number'
    ];
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

     public static function availableForNavigation(Request $request)
     {

         if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("volunteersHowerparmation",  $request->user()->userrole()) )){
             return true;
         }
        else return false;
     }

    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(__('email'), 'email')
                ->sortable()
                ->rules( 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Text::make(__('phone_number'), 'phone_number') ->rules('required'),
            Text::make(__('city'), 'city'),
            Text::make(__('volunteer_from'), 'volunteer_from'),

            Flexible::make(__('hower'), 'hower')
                ->addLayout(__('Add new type'), 'type', [
                    DateTime::make(__('History'), 'Date')
                        ->format('DD/MM/YYYY')
                        ->resolveUsing(function ($value) {
                            return $value;
                        }),

                    Text::make(__('num_hower'), 'num_hower'),

                    Multiselect::make(__('project'), "project")
                    ->options(function () {
                        $types =  VolunteersProjects::all();
                        $type_array =  array();
                        foreach ($types as $type) {
                            $type_array += [$type['id'] => ($type['name'])];
                        }

                        return $type_array;
                    })->hideFromDetail()->hideFromIndex(),

                    Boolean::make(__('done'), 'done'),
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
