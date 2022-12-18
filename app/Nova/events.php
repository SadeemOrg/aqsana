<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Laravel\Nova\Fields\BelongsTo;
use Whitecube\NovaFlexibleContent\Flexible;

class events extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\events::class;
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("eventsparmation",  $request->user()->userrole()) )){
            return true;
        }
       else return false;
    }
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = "name";

    /**
     * The columns that should be searched.
     *
     * @var array
     */

    public static function label()
    {
        return __('events');
    }
    public static function group()
    {
        return __('Cultural Section');
    }
    public static $priority = 3 ;
    public static $search = [
        'id',"name"
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
            Textarea::make(__('note'),'note'),
            Files::make('Multiple files', 'file'),
            Text::make(__('Number of encounters'),'number_of_encounters'),
            // File::make(__('file'),'file')->disk('public')->deletable(),
            Flexible::make(__('new event'), 'new_event')

            ->hideFromDetail()->hideFromIndex()
            ->addLayout(__('Add new event'), 'type', [
                Date::make(__('DATE'), 'events_date')->pickerDisplayFormat('d.m.Y'),
            ]),
            Date::make(__('start DATE'), 'start_events_date')->pickerDisplayFormat('d.m.Y'),
            Date::make(__('end DATE'), 'end_events_date')->pickerDisplayFormat('d.m.Y'),
            Text::make(__('Budget'),'Budget'),
            Flexible::make(__('Contacts'), 'Contacts')

            ->addLayout(__('Add new type'), 'type', [
                Text::make(__('name'), 'name'),
                Text::make(__('phone_number'), 'phone_number'),
            ]),


        ];
    }
    public static function afterSave(Request $request, $model)
    {
        // dd("ddd");
        // dd($request->file);

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
