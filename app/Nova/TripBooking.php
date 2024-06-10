<?php

namespace App\Nova;

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
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("TripBooking",  $request->user()->userrole()))) {
            return true;
        } else return false;
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
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make(__('Qawafil'), 'Project', \App\Nova\QawafilAlaqsa::class)->rules(new CustomRule($request->number_of_people)),
            BelongsTo::make(__('user'), 'Users', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('bus'), 'Buses', \App\Nova\Bus::class)
                ->hideWhenCreating()->hideWhenUpdating(),
            Text::make(__('number phone'), 'number_phone'),
            Text::make(__('number_of_people'), 'number_of_people'),
            Text::make(__('reservation_amount'), 'reservation_amount'),


            HasMany::make(__("ActionEvents"), "ActionEvents", ActionResource::class)

        ];
    }

    public static function beforeSave(Request $request, $model)
    {
        // dd($request->Project);
        $projext = Project::where('id', $request->Project)->with('bus')->first();
        $buss = $projext->bus;
        $IsFull = 1;


        foreach ($buss as $key => $bus) {
            if ($IsFull == 1) {

                $number_of_people =  ModelsTripBooking::where([
                    ['bus_id', $bus->id],
                    ['status', '1'],
                ])->sum('number_of_people');
                $number_of_people += $request->number_of_people;

                if (($number_of_people  < $bus->number_of_seats)) {

                    $model->bus_id = $bus->id;
                    $IsFull = 0;
                }
            }
        }

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
