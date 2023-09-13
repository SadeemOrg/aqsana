<?php

namespace App\Nova;

use Acme\Smssend\Smssend;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Sms extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\TelephoneDirectory::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */

    public static function label()
    {
        return __('Sms');
    }
    public static function group()
    {
        return __('address');
        }
    public static function availableForNavigation(Request $request)
    {
        return false;
        if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("sms",  $request->user()->userrole()) )){
            return true;
        }
       else return false;
    }
    public static $title = 'id';
    public static function createButtonLabel()
    {
        return 'اضافة';
    }
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

     public static function indexQuery(NovaRequest $request, $query)
     {
         return $query->whereJsonContains('type', '9');

     }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make(__('Name'),'name')
                ->sortable()
                ->rules('required', 'max:255'),
                Text::make(__('phone_number'),'phone_number')->rules('required'),
                Text::make(__('city'),'city')->rules('required'),
                HasMany::make(__("ActionEvents"), "ActionEvents", \App\Nova\ActionEvents::class)

        ];
    }
    public static function beforeCreate(Request $request, $model)
    {
        $model->type = 9;
    }
    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            new Smssend()
        ];
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
