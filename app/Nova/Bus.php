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


    public static $model = \App\Models\Bus::class;
    // public static $displayInNavigation = false;
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



        // 'Created_By','Update_By'
        return [
            ID::make(__('ID'), 'id')->sortable(),
            // Text::make("Name","name"),
            BelongsTo::make('company', 'company', \App\Nova\busescompany::class),
            Text::make("Bus Number","bus_number"),
            Number::make("Number person on bus","number_person_on_bus")->step(1.0),
            // BelongsTo::make('address','address'),
            // BelongsTo::make('address','address'),
            BelongsTo::make('travel from', 'travelfrom', \App\Nova\address::class),
            BelongsTo::make('travel to', 'travelto', \App\Nova\address::class),
            BelongsTo::make('current location', 'currentlocation', \App\Nova\address::class),

            // BelongsTo::make('address','travel_to'),

            // BelongsTo::make('address','current_location'),

            // GoogleMaps::make('travel from', 'travel_from')
            // ->zoom(8),
            // GoogleMaps::make('travel to', 'travel_to')
            // ->zoom(8) ,
            // GoogleMaps::make('current_location', 'current_location')
            // ->zoom(8) ,
            Text::make("Name Driver","name_driver"),
            Text::make("phone_number","phone_number"),



            Select::make("status","status")
            ->options([
                '1' => 'available',
                '2' => 'un available',


                ])->displayUsingLabels(),
                BelongsTo::make('created by', 'create', \App\Nova\User::class)->hideWhenCreating()->
                hideWhenUpdating(),
                BelongsTo::make('Update by', 'Updateby', \App\Nova\User::class)->hideWhenCreating()->
                hideWhenUpdating(),
                // belongsTo::make('projects', 'projects','App\Nova\ProjectQawafilAlaqsa')->hideWhenCreating()->
                // hideWhenUpdating(),
                // belongsToMany::make('projects', 'projects', 'App\Nova\project'),

            ];


    }


    public static function beforeSave(Request $request, $model)
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
