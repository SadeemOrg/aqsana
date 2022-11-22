<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
class TelephoneDirectory extends Resource
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
    public static $title = 'name';
    public static function label()
    {
        return __('TelephoneDirectory');
    }
    public static function group()
    {
        return __('address');
    }

    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("TelephoneDirectoryparmation",  $request->user()->userrole()) )){
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

            Text::make(__('Name'),'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make(__('Email'),'email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),
            Select::make(__('type'), 'type')->options([
                1 => __('متبرعين سجب ثابت'),
                2 => __('متبرعين لمرة واحدة '),
                3 => __('مندوبين'),
                4 => __('متطوعين'),
                5 => __('جهات اتصال عامة'),
                6 => __('مرشدين'),
                7 => __('منح'),
            ])->displayUsingLabels(),

            Text::make(__('phone_number'),'phone_number'),
            Text::make(__('city'),'city'),
            Text::make(__('roles'),'roles'),
            Text::make(__('jop'),'jop'),
            Text::make(__('id_number'),'id_number'),





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
