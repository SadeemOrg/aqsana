<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Laravel\Nova\Http\Requests\NovaRequest;

class Area extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $group = 'Admin';
    public static $model = \App\Models\Area::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';


    public static $priority = 2;


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
            Text::make('Name','name'),
            Text::make('Describtion','describtion'),

            Select::make('admin','admin_id',)
            ->options( function() {
                $users =  \App\Models\User::where('user_role', '=', 'regular_area')->get();

                $user_type_admin_array =  array();

                foreach($users as $user) {
                    $user_type_admin_array += [$user['id'] => ($user['name'] . " (". $user['user_role'] .")")];
                }

                return $user_type_admin_array;
               })->hideFromIndex()->hideFromDetail(),
               BelongsTo::make('admin city', 'admin', \App\Nova\User::class)->hideWhenCreating()->
                  hideWhenUpdating(),
                  BelongsTo::make('created by', 'create', \App\Nova\User::class)->hideWhenCreating()->
                  hideWhenUpdating(),


               HasMany::make("City","City")
        ];
    }

    public static function afterCreate(Request $request, $model)
    {
        $id = Auth::id();
        $model->update([
            'created_by'=>$id,

        ]);
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
