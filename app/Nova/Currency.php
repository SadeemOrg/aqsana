<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Currency extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Currency::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static function label()
    {
        return __('Currency');
    }
    public static function group()
    {
        return __('Admin');
    }

    public static $title = 'name';
    public static $priority = 6;
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
    {    // 'Update_By'

        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Name','name'),
            Text::make('code','code'),
            Number::make('rate','rate')->step(0.01),

            BelongsTo::make('created by', 'create', \App\Nova\User::class)->hideWhenCreating()->
            hideWhenUpdating(),
            BelongsTo::make('Update by', 'Updateby', \App\Nova\User::class)->hideWhenCreating()->
            hideWhenUpdating(),
        ];
    }

    public static function beforeSave(Request $request, $model)
    {
        $id = Auth::id();
        $model->created_by=$id;
    }


    public static function beforeUpdate(Request $request, $model)
    {
        $id = Auth::id();
        $model->update_by=$id;


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
