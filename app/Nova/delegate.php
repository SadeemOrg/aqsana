<?php

namespace App\Nova;

use App\Nova\Filters\AreaDelegate;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Techouse\SelectAutoComplete\SelectAutoComplete as Select;

class delegate extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\TelephoneDirectory::class;
    public static function label()
    {
        return __('delegatee');
    }
    public static function group()
    {
        return __('QawafilAlaqsa');
    }
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("delegatee",  $request->user()->userrole()) )){
            return true;
        }
       else return false;
    }
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'phone_number'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('type', '3');

    }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(__('email'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),
            Text::make(__('phone_number'), 'phone_number'),
            Select::make(__('Area'), 'Area')
            ->options(function () {
                $Areas =  \App\Models\Area::all();

                $Area_type_admin_array =  array();

                foreach ($Areas as $Area) {


                    $Area_type_admin_array += [$Area['id'] => ($Area['name'])];
                }

                return $Area_type_admin_array;
            })->hideFromIndex()->hideFromDetail(),
            BelongsTo::make(__('Area'), 'AreaDelegate', \App\Nova\Area::class)->hideWhenCreating()->hideWhenUpdating(),
            Text::make(__('city'), 'city'),
        ];
    }
    public static function beforeCreate(Request $request, $model)
    {
        $model->type = 3;
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
        return [
            new AreaDelegate
        ];
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
