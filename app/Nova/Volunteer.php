<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Volunteer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */

    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("Volunteerparmation",  $request->user()->userrole()) )){
            return true;
        }
       else return false;
    }
    public static $model = \App\Models\Volunteer::class;
    public static function label()
    {
        return __('Volunteers');
    }

    public static function group()
    {
        return __('VolunteersE');
    }
    public static function groupOrder() {
        return 6 ;
    }
    // public static $subGroup = 'Vendors';
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
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make(__('project'), 'project', \App\Nova\Project::class),
            BelongsTo::make(__('user'), 'User', \App\Nova\User::class),
            Select::make(__("Status"), "address_status")->options([
                '1' => __('Volunteer'),
                '0' => __('not Volunteer'),
            ])->displayUsingLabels(),


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
