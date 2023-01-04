<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class Tours extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Tours::class;
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("Tours",  $request->user()->userrole()) )){
            return true;
        }
       else return false;
    }
    public static function label()
    {
        return __('Tours');
    }
    public static function group()
    {
        return __('Cultural Section');
    }
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
            Text::make(__('name'),'name'),
            Date::make(__('DATE'), 'date')->pickerDisplayFormat('d.m.Y'),
            Text::make(__('number_of_people'),'number_of_people'),
            Flexible::make(__('Contacts'), 'Contacts')

            ->addLayout(__('Add new type'), 'type', [
                Text::make(__('name'), 'name'),
                Text::make(__('phone_number'), 'phone_number'),
            ]),
            Text::make(__('guide_name'),'guide_name'),
            Date::make(__('start Time'), 'start_tour')->pickerDisplayFormat('d.m.Y'),
            Date::make(__('end Time'), 'end_tour')->pickerDisplayFormat('d.m.Y'),
            Textarea::make(__('note'),'note'),
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
