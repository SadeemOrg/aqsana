<?php

namespace App\Nova;

use Acme\BookingsBus\BookingsBus;
use Acme\MultiselectField\Multiselect;
use Acme\NumberField\NumberField;
use App\Models\Bus;
use App\Models\Project;
use App\Models\TripBooking as ModelsTripBooking;
use App\Rules\CustomRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Validation\ValidationException;
use Laravel\Nova\Actions\ActionResource;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;

class TripBooking extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static function createButtonLabel()
    {
        return 'انشاء حجز';
    }
    public static $model = \App\Models\TripBooking::class;
    public static function label()
    {
        return __('TripBooking');
    }
    public static function group()
    {
        return __('QawafilAlaqsa');
    }
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static function availableForNavigation(Request $request)
    {
        return false;
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("TripBooking",  $request->user()->userrole()))) {
        } else return false;
        return true;
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];
    // public static function groupOrder() {
    //     return 10;
    // }
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function authorizedToUpdate(Request $request)
    {
        return false;
    }
    public function fields(Request $request)
    {
        $viaResourceId = $request->input('viaResourceId');
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make(__('Qawafil'), 'Project', \App\Nova\QawafilAlaqsa::class),
            BookingsBus::make("", 'hi', function () use ($viaResourceId) {
                return $viaResourceId;
            })->hideFromDetail()->hideFromIndex()->readonly(),

            Multiselect::make(__('bus'), 'bus_id')
                ->options(function () use ($viaResourceId){
                    $projext = Project::where('id', $viaResourceId)->with('bus')->first();
                    if (isset($projext)) {
                        $Area_type_admin_array =  array();
                        $buss = $projext->bus;

                        foreach ($buss as $key => $bus) {


                            $Area_type_admin_array += [$bus['id'] => ($bus['bus_number'])];
                        }

                        return $Area_type_admin_array;
                    }



                })->singleSelect()->rules('required',new CustomRule($request->number_of_people,$viaResourceId))->hideFromIndex()->hideFromDetail(),


            BelongsTo::make(__('user'), 'Users', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('bus'), 'Buses', \App\Nova\Bus::class)
                ->hideWhenCreating()->hideWhenUpdating(),
            Text::make(__('number phone'), 'number_phone')->rules('required'),
            NumberField::make(__('number_of_people'), 'number_of_people')->rules('required'),

            NumberField::make(__('reservation_amount'), 'reservation_amount')->rules('required') ,

            HasMany::make(__("ActionEvents"), "ActionEvents", ActionResource::class)

        ];
    }

    public static function beforeSave(Request $request, $model)
    {
        // $projext = Project::where('id', $request->Project)->with('bus')->first();
        // $buss = $projext->bus;
        // $IsFull = $request->number_of_people_bus;
        // $request->request->remove('number_of_people_bus');

        // foreach ($buss as $key => $bus) {

        //     if ($IsFull > 0) {

        //         $number_of_people = ModelsTripBooking::where([
        //             ['bus_id', $bus->id],
        //             ['status', '1'],
        //         ])->sum('number_of_people');
        //         if ((($bus->number_of_seats - $number_of_people) >= $IsFull) && $key == 0) {

        //             $model->bus_id = $bus->id;
        //             $model->number_of_people = $IsFull;
        //             $model->project_id = $request->project_id;
        //             $IsFull = 0;
        //         } else {
        //             if ($key == 0) {
        //                 $model->bus_id = $bus->id;
        //                 $model->project_id = $request->project_id;
        //                 $IsFull = $IsFull - ($bus->number_of_seats - $number_of_people);
        //                 $model->number_of_people = ($bus->number_of_seats - $number_of_people);
        //             } else {
        //                 $ModelsTripBooking = new ModelsTripBooking();
        //                 $ModelsTripBooking->project_id = $request->Project;
        //                 $ModelsTripBooking->bus_id = $bus->id;
        //                 $ModelsTripBooking->booking_type = 2;
        //                 $ModelsTripBooking->number_of_people = $IsFull;
        //                 $ModelsTripBooking->reservation_amount = 0;
        //                 $ModelsTripBooking->number_phone = $request->number_phone;
        //                 $ModelsTripBooking->save();
        //                 $IsFull = $IsFull;
        //             }
        //         }
        //     }
        // }


        $model->booking_type = 2;
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
