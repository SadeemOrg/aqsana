<?php

namespace App\Nova;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Select;

class City extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static function label()
    {
        return __('City');
    }
    public static function group()
    {
        return __('Admin');
    }

    public static $model = \App\Models\City::class;
    public static $priority = 2;
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
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public static function indexQuery(NovaRequest $request, $query)
    {
        $user = Auth::user();
        $id = Auth::id();
        if ($user->type() == 'admin') {
            return $query;
        } elseif ($user->type() == 'regular_area') {

            $area = \App\Models\area::with('City')->where('admin_id', $id)->first();
            $areas = $area->toArray();
            $cites = $areas['city'];

            $stack = array();
            foreach ($cites as $key => $value) {
                array_push($stack, $value['name']);
            }
            return $query->whereIn('name', $stack);
        } else {

            $cites = \App\Models\City::where('admin_id', $id)->get();


            $stack = array();
            foreach ($cites as $key => $value) {
                array_push($stack, $value['name']);
            }
            return $query->whereIn('name', $stack);
        }
    }
    public function fields(Request $request)
    {
        $user = Auth::user();

        if ($user->type() == 'admin') {
            return [
                ID::make(__('ID'), 'id')->sortable(),
                Text::make('Name', 'name'),
                BelongsTo::make('Area', 'Area'),
                Select::make('admin', 'admin_id')
                    ->options(function () {
                        $users =  \App\Models\User::where('user_role', '=', 'regular_city')->get();

                        $user_type_admin_array =  array();

                        foreach ($users as $user) {


                            if ($user->City == null || $this->admin_id == $user['id']) {
                                $user_type_admin_array += [$user['id'] => ($user['name'] . " (" . $user['user_role'] . ")")];
                            }
                        }
                        return $user_type_admin_array;
                    })->hideFromIndex()->hideFromDetail(),
                BelongsTo::make('admin city', 'admin', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),

                BelongsTo::make('created by', 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
                BelongsTo::make('Update by', 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
                hasMany::make('User', 'User'),
            ];
        }
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Name', 'name'),

            BelongsTo::make('Area', 'Area')->hideWhenCreating()->hideWhenUpdating(),

            Select::make('admin', 'admin_id')
                ->options(function () {
                    $users =  \App\Models\User::where('user_role', '=', 'regular_city')->get();

                    $user_type_admin_array =  array();

                    foreach ($users as $user) {
                        $user_type_admin_array += [$user['id'] => ($user['name'] . " (" . $user['user_role'] . ")")];
                    }

                    return $user_type_admin_array;
                })->hideFromIndex()->hideFromDetail(),
            BelongsTo::make('admin city', 'admin', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make('created by', 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make('Update by', 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            // hasMany::make('User','User'),
        ];
    }


    public static function beforeUpdate(Request $request, $model)
    {
        $id = Auth::id();
        $model->update_by = $id;
    }
    public static function beforeSave(Request $request, $model)
    {
        $user = Auth::user();
        $id = Auth::id();
        if ($user->type() == 'admin') {
            $model->created_by = $id;
        } else {
            $user = DB::table('areas')->where('admin_id', $id)->select('id')->first();
            $model->update_by = $id;
            $model->area_id = $user->id;
        }
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
