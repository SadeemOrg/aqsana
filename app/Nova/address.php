<?php

namespace App\Nova;

use Acme\MultiselectField\Multiselect;
use App\Nova\Actions\ExportAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaGoogleMaps\GoogleMaps;
use Mauricewijnia\NovaMapsAddress\MapsAddress;
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
        if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("addressparmation",  $request->user()->userrole()) )){
            return true;
        }
       else return false;
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
                })->singleSelect()->hideFromIndex()->hideFromDetail(),
            // Select::make(__("type"), "type")->options([
            //     '1' => __('bus'),
            //     '2' => __('Alhisalat'),
            //     '3' => __('Project'),

            // ])->displayUsingLabels()->rules('required'),
            Text::make(__('name address'), "name_address")->rules('required'),
            Text::make(__("description address"), "description"),
            Text::make(__("phone number"), "phone_number_address"),

            // GoogleMaps::make(__('current_location'), 'current_location')
            //     ->zoom(8),

                MapsAddress::make(__('Address'), 'current_location') ->zoom(10)

                ->center(['lat' =>  31.775947, 'lng' => 35.235577]) ->types(['address' ,'establishment'])->mapOptions(['fullscreenControl' => true,'clickableIcons'=>true,'restriction'=>true]),

            // Select::make(__("Status"), "status")->options([
            //     '1' => __('active'),
            //     '2' => __('not active'),
            // ])->displayUsingLabels(),
            // BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            HasMany::make(__("ActionEvents"), "ActionEvents", \App\Nova\ActionEvents::class)

        ];
    }

    public static function beforeUpdate(Request $request, $model)
    {
        $address=    \App\Models\address::find($model->id);

        $data =$address->current_location;


        $data['street_name'] =($request->street_name != null) ?$request->street_name : $data['street_name'] ;
        $data['city']  =($request->city != null) ?$request->city : $data['city'] ;
        $data['latitude']  =($request->latitude != null) ?(float)$request->latitude :(float) $data['latitude'] ;
        $data['longitude']  =($request->longitude != null) ?(float)$request->longitude : (float)$data['longitude'] ;
        $data['formatted_address'] =  $data['street_name'].','.   $data['city'] ;

        $request->request->remove('street_name');
        $request->request->remove('city');
        $request->request->remove('latitude');
        $request->request->remove('longitude');
        $model->current_location=$data;
    }
    public static function beforeCreate(Request $request, $model)
    {

        $json = \File::get('sample.json');
        $data = json_decode($json);
        $data->street_name =$request->street_name;
        $data->city =$request->city;
        $data->latitude =(float)$request->latitude;
        $data->longitude =(float)$request->longitude;
        $data->formatted_address=$request->street_name.','.$request->city;

        $request->request->remove('street_name');
        $request->request->remove('city');
        $request->request->remove('latitude');
        $request->request->remove('longitude');
        $model->current_location=$data;

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
