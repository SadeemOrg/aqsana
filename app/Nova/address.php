<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaGoogleMaps\GoogleMaps;

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
    public static function indexQuery(NovaRequest $request, $query)
    {
        $id = Auth::id();
        // return $query->whereIn('created_by',  $id );


    }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Select::make(__("type"), "type")->options([
                '1' => __('bus'),
                '2' => __('Alhisalat'),
                '3' => __('Project'),
                '4' => __('addrese buss'),
            ])->displayUsingLabels(),
            Text::make(__('Name'), "name_address"),
            Text::make(__("description"), "description"),
            Text::make(__("phone number"), "phone_number_address"),

            GoogleMaps::make(__('current_location'), 'current_location')
                ->zoom(8),
            Select::make(__("Status"), "status")->options([
                '1' => __('active'),
                '2' => __('not active'),
            ])->displayUsingLabels(),
            BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),

        ];
    }
    public static function beforeCreate(Request $request, $model)
    {
        $id = Auth::id();
        $model->created_by = $id;

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
