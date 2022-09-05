<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Yassi\NestedForm\NestedForm;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Whitecube\NovaGoogleMaps\GoogleMaps;
use Illuminate\Support\Facades\Auth;

class Bus extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static function label()
    {
        return __('Bus');
    }
    public static function group()
    {
        return __('Admin');
    }

    public static $priority = 5;
    public static $model = \App\Models\Bus::class;
    // public static $displayInNavigation = false;
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'bus_number';

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
            BelongsTo::make(__('company'), 'company', \App\Nova\BusesCompany::class),
            Text::make(__("Bus Number"), "bus_number"),
            Number::make(__("Number person on bus"), "number_of_seats")->step(1.0),
            Number::make(__("seat price"), "seat_price")->step(1.0),
            BelongsTo::make(__('travel from'), 'travelfrom', \App\Nova\address::class),
            BelongsTo::make(__('travel to'), 'travelto', \App\Nova\address::class),
            Text::make(__("Name Driver"), "name_driver"),
            Text::make(__("phone_number"), "phone_number_driver"),
            Select::make(__("status"), "status")
                ->options([
                    '1' => 'available',
                    '2' => 'un available',
                ])->displayUsingLabels(),
            BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('Update by'), 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),


        ];
    }


    public static function beforeCreate(Request $request, $model)
    {
        $id = Auth::id();
        $model->created_by=$id;
    }


    public static function beforeUpdate(Request $request, $model)
    {
        $id = Auth::id();
        $model->update_by=$id;


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
