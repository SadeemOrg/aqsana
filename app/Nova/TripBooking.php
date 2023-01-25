<?php

namespace App\Nova;

use App\Models\Bus;
use App\Rules\CustomRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Validation\ValidationException;
class TripBooking extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
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
        if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("TripBooking",  $request->user()->userrole()) )){
            return true;
        }
       else return false;
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
            BelongsTo::make(__('project'), 'Project', \App\Nova\Project::class),
            BelongsTo::make(__('user'), 'Users', \App\Nova\User::class),
            BelongsTo::make(__('bus'), 'Buses', \App\Nova\Bus::class)->rules(new CustomRule($request->number_of_people)),
            // Text::make(__('number phone'), 'number_phone'),
            Text::make(__('number_of_people'), 'number_of_people'),
            Text::make(__('reservation_amount'), 'reservation_amount'),



        ];
    }

    public static function beforeSave(Request $request, $model)
    {

        $model->booking_type = 2 ;
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
