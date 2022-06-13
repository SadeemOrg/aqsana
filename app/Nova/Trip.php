<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Whitecube\NovaGoogleMaps\GoogleMaps;

use Acme\MultiselectField\Multiselect;
use App\Models\User;
use App\Models\Bus;
use Laravel\Nova\Http\Requests\NovaRequest;

class Trip extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Trip::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';
    public static $group = 'Admin';

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
                Text::make("Name","name"),
                Textarea::make("Description","description"),
                Text::make("Trip goal","trip_goal"),


                Select::make('admin','admin_id',)
                ->options( function() {
                    $users =  \App\Models\User::where('user_roll', '=', 'admin')->get();

                    $user_type_admin_array =  array();

                    foreach($users as $user) {
                        $user_type_admin_array += [$user['id'] => ($user['name'] . " (". $user['user_roll'] .")")];
                    }

                    return $user_type_admin_array;
                   })->hideFromIndex()->hideFromDetail(),

                   BelongsTo::make('admin ', 'User', \App\Nova\User::class)->hideWhenCreating()->
                     hideWhenUpdating(),


                         BelongsTo::make('from city', 'from', \App\Nova\City::class),
                        BelongsTo::make('to city', 'tocity', \App\Nova\City::class),



                Number::make("buses number","buses_number"),
                Number::make("participants number","participants_number"),

                Multiselect::make('Buses','bus_id')
                    ->options( function() {
                    $buses_db = Bus::all();
                    $buses =  array();

                    foreach($buses_db as $bus) {
                    $buses += [$bus['id'] => ($bus['name_driver'])];
                    }

                    return $buses;
                    })
                    ->saveAsJSON(),

                DateTime::make('Start time','start_time'),
                DateTime::make('End time','end_time'),

                Select::make('Status','status')->options([
                    'wate tipe' => 'wate tipe',
                    'in tipe' => 'in tipe',
                    ' tipe' => ' tipe',

                    ])->displayUsingLabels(),
                Number::make("Cost","cost"),


                Multiselect::make("Repetition","repetition")->options([
                    '1' => 'Once',
                    '2' => 'daily',
                    '3' => 'weekly',
                    '4' => 'Monthly',
                    ])->singleSelect(),
           // GoogleMaps::make('Map')
                // ->zoom(8) // Optionally set the zoom level
                // ->defaultCoordinates(1200, 1233), // Optionally set the map's default center point
                    // HasMany::make("Buses","bus")



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
