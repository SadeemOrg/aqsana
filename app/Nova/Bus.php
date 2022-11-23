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
use Illuminate\Support\Facades\DB;
use Whitecube\NovaFlexibleContent\Flexible;

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
        return __('the Busss');
    }
    // public static $displayInNavigation = false;

    public static $priority = 2;
    public static $model = \App\Models\Bus::class;
    public static $displayInNavigation = false;
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
        'id','bus_number'
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
            Text::make(__("Bus Name"), "bus_number"),
            Number::make(__("Number person on bus"), "number_of_seats")->step(1.0),
            Number::make(__("seat price"), "seat_price")->step(1.0),
            // BelongsTo::make(__('trip from'), 'travelfrom', \App\Nova\address::class)->hideWhenCreating()->hideWhenUpdating(),

            // Select::make(__('trip from'), 'travel_from')
            //     ->options(function () {
            //         $id = Auth::id();
            //         $addresss =  \App\Models\address::where('type','1')->get();
            //         $address_type_admin_array =  array();

            //         foreach ($addresss as $address) {

            //             if ($address->Area == null || $this->admin_id == $address['id']) {
            //                 $address_type_admin_array += [$address['id'] => ($address['name_address'])];
            //             }
            //         }

            //         return $address_type_admin_array;
            //     })->hideFromIndex()->hideFromDetail()
            //     ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
            //         return null;
            //     }),
            // Flexible::make(__('newadres'), 'newadresfrom')
            //     ->readonly(true)
            //     ->limit(1)
            //     ->hideFromDetail()->hideFromIndex()
            //     ->addLayout(__('Add new bus'), 'bus', [

            //         Text::make(__('Name'), "name_address"),
            //         Text::make(__("description"), "description"),
            //         Text::make(__("phone number"), "phone_number_address"),
            //         GoogleMaps::make(__('current_location'), 'current_location'),
            //         Select::make(__("Status"), "address_status")->options([
            //             '1' => __('active'),
            //             '2' => __('not active'),
            //         ]),

            //     ]),




            // BelongsTo::make(__('trip to'), 'travelto', \App\Nova\address::class)->hideWhenCreating()->hideWhenUpdating(),
            // Select::make(__('trip to'), 'travel_to')
            //     ->options(function () {
            //         $id = Auth::id();
            //         $addresss =  \App\Models\address::where('type','1')->get();
            //         $address_type_admin_array =  array();

            //         foreach ($addresss as $address) {

            //             if ($address->Area == null || $this->admin_id == $address['id']) {
            //                 $address_type_admin_array += [$address['id'] => ($address['name_address'])];
            //             }
            //         }

            //         return $address_type_admin_array;
            //     })->hideFromIndex()->hideFromDetail()
            //     ->fillUsing(function (NovaRequest $request, $model, $attribute, $requestAttribute) {
            //         return null;
            //     }),
            // Flexible::make(__('newadres'), 'newadresto')
            //     ->readonly(true)
            //     ->limit(1)
            //     ->hideFromDetail()->hideFromIndex()
            //     ->addLayout(__('Add new bus'), 'bus', [

            //         Text::make(__('Name'), "name_address"),
            //         Text::make(__("description"), "description"),
            //         Text::make(__("phone number"), "phone_number_address"),
            //         GoogleMaps::make(__('current_location'), 'current_location'),
            //         Select::make(__("Status"), "address_status")->options([
            //             '1' => __('active'),
            //             '2' => __('not active'),
            //         ]),

            //     ]),

            Text::make(__("Name Driver"), "name_driver"),
            Text::make(__("phone_number"), "phone_number_driver"),
            Select::make(__("status"), "status")
                ->options([
                    '1' => __('available'),
                    '2' => __('un available'),
                ])->displayUsingLabels(),
            BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('Update by'), 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),

HasMany::make('TripBookings')
        ];
    }


    public static function beforeCreate(Request $request, $model)
    {
        $id = Auth::id();
        $model->created_by = $id;
    }


    public static function beforeUpdate(Request $request, $model)
    {
        $id = Auth::id();
        $model->update_by = $id;
    }
    public static function beforeSave(Request $request, $model)
    {
        $id = Auth::id();
        if (!$request->travel_from && $request->newadresfrom) {
            if ($request->newadresfrom[0]['attributes']['name_address'] && $request->newadresfrom[0]['attributes']['description'] && $request->newadresfrom[0]['attributes']['phone_number_address'] && $request->newadresfrom[0]['attributes']['current_location'] && $request->newadresfrom[0]['attributes']['address_status']) {

                //   dd("hf");
                DB::table('addresses')
                    ->Insert(
                        [
                            'name_address' => $request->newadresfrom[0]['attributes']['name_address'],
                            'description' => $request->newadresfrom[0]['attributes']['description'],
                            'phone_number_address' => $request->newadresfrom[0]['attributes']['phone_number_address'],
                            'current_location' => $request->newadresfrom[0]['attributes']['current_location'],
                            'status' => $request->newadresfrom[0]['attributes']['address_status'],
                            'type' => '1',
                            'created_by' => $id
                        ]
                    );
                $address =  \App\Models\address::where('name_address',  $request->newadresfrom[0]['attributes']['name_address'])->first();
                DB::table('projects')
                    ->where('id', $model->id)
                    ->update(['trip_from' => $address->id]);
            }
        } else   $model->travel_from = $request->travel_from;



        if (!$request->travel_to && $request->newadresfrom) {
            if ($request->newadresto[0]['attributes']['name_address'] && $request->newadresto[0]['attributes']['description'] && $request->newadresto[0]['attributes']['phone_number_address'] && $request->newadresto[0]['attributes']['current_location'] && $request->newadresto[0]['attributes']['address_status']) {
                //   dd("hf");
                DB::table('addresses')
                    ->Insert(
                        [
                            'name_address' => $request->newadresto[0]['attributes']['name_address'],
                            'description' => $request->newadresto[0]['attributes']['description'],
                            'phone_number_address' => $request->newadresto[0]['attributes']['phone_number_address'],
                            'current_location' => $request->newadresto[0]['attributes']['current_location'],
                            'status' => $request->newadresto[0]['attributes']['address_status'],
                            'type' => '1',
                            'created_by' => $id
                        ]
                    );
                $address =  \App\Models\address::where('name_address',  $request->newadresto[0]['attributes']['name_address'])->first();
                DB::table('projects')
                    ->where('id', $model->id)
                    ->update(['trip_to' => $address->id]);
            }
        } else   $model->travel_to = $request->travel_to;
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
