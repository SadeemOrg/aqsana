<?php

namespace App\Nova;

use Acme\MultiselectField\Multiselect;
use App\Models\Area;
use App\Nova\Actions\ExportAddress;
use devops\MapAddress\MapAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaGoogleMaps\GoogleMaps;
use Mauricewijnia\NovaMapsAddress\MapsAddress;
use Orlyapps\NovaBelongsToDepend\NovaBelongsToDepend;

class address extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\address::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name_address';
    public static function label()
    {
        return __('saved addresss');
    }
    public static function group()
    {
        return __('address');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $priority = 3;
    public static $search = [
        'id', "name_address"
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("addressparmation",  $request->user()->userrole()))) {
            return true;
        } else return false;
    }
    public static function createButtonLabel()
    {
        return 'انشاء عنوان';
    }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Multiselect::make(__('type'), 'type')
                ->options(function () {
                    $AddressTypes =  \App\Models\AddressType::where('active', '1')->get();
                    $address_type_admin_array =  array();

                    foreach ($AddressTypes as $AddressType) {

                        $address_type_admin_array += [$AddressType['id'] => ($AddressType['name'])];
                    }

                    return $address_type_admin_array;
                })->singleSelect()->hideFromIndex()->hideFromDetail()->rules('required'),

            Text::make(__('name address'), "name_address")->rules('required'),
            Text::make(__("description address"), "description")->rules('required'),
            Text::make(__("phone number"), "phone_number_address"),


            NovaBelongsToDepend::make(__('Area'), 'Area', \App\Nova\Area::class)
                ->placeholder('Optional Placeholder') // Add this just if you want to customize the placeholder
                ->options(Area::all()),

            NovaBelongsToDepend::make(__('City'), 'City', \App\Nova\City::class)

                ->placeholder('Optional Placeholder') // Add this just if you want to customize the placeholder
                ->optionsResolve(function ($Area) {
                    return  $Area->City()->get(['id', 'name']);
                })
                ->dependsOn('Area')->hideFromIndex()->hideFromDetail(),

            Multiselect::make(__('delegatee'), 'admin_id')
                ->options(function () {
                    $users =  \App\Models\TelephoneDirectory::whereJsonContains('type',  '3')->get();
                    $user_type_admin_array =  array();
                    foreach ($users as $user) {
                        $user_type_admin_array += [$user['id'] => ($user['name'])];
                    }

                    return $user_type_admin_array;
                })->singleSelect(),

            MapsAddress::make(__('Address'), 'current_location')
                ->zoom(15)->center(['lat' =>  31.77624246761854, 'lng' => 35.236198620223036])
                ->types(['establishment']),
            HasMany::make(__("ActionEvents"), "ActionEvents", ActionResource::class)

        ];
    }


    public static function beforeCreate(Request $request, $model)
    {
        $id = Auth::id();
        $model->created_by = $id;
        $model->status = 1;
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
        return [
            (new ExportAddress)->standalone()->withoutConfirmation(),

        ];
    }
}
