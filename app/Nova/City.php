<?php

namespace App\Nova;

use Acme\MultiselectField\Multiselect;
use App\Models\User;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Techouse\SelectAutoComplete\SelectAutoComplete as Select;
use Whitecube\NovaFlexibleContent\Flexible;

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
        return __('address');
    }
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole())) || (in_array("Cityparmation",  $request->user()->userrole()))) {
            return true;
        } else return false;
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

            $areasadmin = \App\Models\Area::with('City')->where('admin_id', $id)->get();
            $stack = array();
            foreach ($areasadmin as $key => $area) {
                $areas = $area->toArray();
                $cites = $areas['city'];



                foreach ($cites as $key => $value) {
                    array_push($stack, $value['name']);
                }
            }
// dd( $stack);
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


            return [
                ID::make(__('ID'), 'id')->sortable(),
                Text::make(__('Name'), 'name')->rules('required'),
                BelongsTo::make(__('Area'), 'Area', \App\Nova\Area::class),

                BelongsTo::make(__('admin city'), 'admin', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),

                Multiselect::make(__('admin'), 'admin_id')
                    ->options(function () {
                        $users =  \App\Models\TelephoneDirectory::where('type', '=', '3')->get();

                        $user_type_admin_array =  array();

                        foreach ($users as $user) {



                            $user_type_admin_array += [$user['id'] => ($user['name'])];
                        }
                        return $user_type_admin_array;
                    })
                    ->singleSelect()
                    ->rules('required')->hideFromDetail()->hideFromIndex(),
                Multiselect::make(__('Alhisalat_admin'), 'Alhisalat_admin')
                    ->options(function () {
                        $users =  \App\Models\TelephoneDirectory::where('type', '=', '3')->get();

                        $user_type_admin_array =  array();

                        foreach ($users as $user) {



                            $user_type_admin_array += [$user['id'] => ($user['name'])];
                        }
                        return $user_type_admin_array;
                    })->rules('required')->singleSelect()->hideFromDetail()->hideFromIndex(),
                    BelongsTo::make(__('Alhisalat_admin'), 'AlhisalatAdmin', \App\Nova\TelephoneDirectory::class)->hideWhenCreating()->hideWhenUpdating(),

                    Flexible::make(__('Alhisalat_sub_admin'), 'Alhisalat_sub_admin')

                    ->addLayout(__('Alhisalat_sub_admin'), 'Alhisalat_sub_admin', [
                        Multiselect::make(__('Alhisalat_sub_admin'), 'Alhisalat_sub_admin')
                        ->options(function () {
                            $users =  \App\Models\TelephoneDirectory::where('type', '=', '3')->get();

                            $user_type_admin_array =  array();

                            foreach ($users as $user) {



                                $user_type_admin_array += [$user['id'] => ($user['name'])];
                            }
                            return $user_type_admin_array;
                        })->rules('required')->singleSelect(),

                    ]),

                    BelongsTo::make(__('Qawafil_admin'), 'QawafilAdmin', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),

                 Multiselect::make(__('Qawafil_admin'), 'Qawafil_admin')
                    ->options(function () {
                        $users =  \App\Models\TelephoneDirectory::where('type', '=', '3')->get();

                        $user_type_admin_array =  array();

                        foreach ($users as $user) {


                            $user_type_admin_array += [$user['id'] => ($user['name'])];
                        }
                        return $user_type_admin_array;
                    })->rules('required')->singleSelect()->hideFromDetail()->hideFromIndex(),
                    Flexible::make(__('Qawafil_sub_admin'), 'Qawafil_sub_admin')

                    ->addLayout(__('Qawafil_sub_admin'), 'Qawafil_sub_admin', [
                        Multiselect::make(__('Qawafil_sub_admin'), 'Qawafil_sub_admin')
                        ->options(function () {
                            $users =  \App\Models\TelephoneDirectory::where('type', '=', '3')->get();

                            $user_type_admin_array =  array();

                            foreach ($users as $user) {



                                $user_type_admin_array += [$user['id'] => ($user['name'])];
                            }
                            return $user_type_admin_array;
                        })->rules('required')->singleSelect(),

                    ]),
                BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
                BelongsTo::make(__('Update by'), 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
                HasMany::make(__("ActionEvents"), "ActionEvents", \App\Nova\ActionEvents::class)

            ];

        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Name'), 'name'),

            BelongsTo::make(__('Area'), 'Area', \App\Nova\Area::class)->hideWhenCreating()->hideWhenUpdating(),





            BelongsTo::make(__('admin city'), 'admin', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            // BelongsTo::make(__('Alhisalat_admin'), 'Alhisalat_admin', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            // BelongsTo::make(__('Qawafil_admin'), 'Qawafil_admin', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),

            BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('Update by'), 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            // hasMany::make('User','User'),
            HasMany::make(__("ActionEvents"), "ActionEvents", \App\Nova\ActionEvents::class)

        ];
    }


    public static function beforeCreate(Request $request, $model)
    {


        $id = Auth::id();
        $model->created_by = $id;
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

    public static function beforeSave(Request $request, $model)
    {

        if (!$request->Alhisalat_admin) {
            $model->Alhisalat_admin = $request->admin_id;
            // dd($model->Alhisalat_admin);
        }
        if (!$request->Qawafil_admin) {
            $model->Qawafil_admin = $request->admin_id;
            // dd($request->Qawafil_admin);
        }
    }
    public static function beforeUpdate(Request $request, $model)
    {

        $id = Auth::id();
        $model->update_by = $id;

        // if (! $request->Alhisalat_admin) {
        //     $model->Alhisalat_admin = $request->admin_id;
        //     // dd($model->Alhisalat_admin);
        //   }
        //   if (! $request->Qawafil_admin) {
        //     $model->Qawafil_admin = $request->admin_id;
        //     // dd($request->Qawafil_admin);
        //   }
    }
    // public static function beforeUpdate(Request $request, $model)
    // {
    //     $id = Auth::id();
    //     $model->update_by = $id;
    // }

    // public static function beforeCreate(Request $request, $model)
    // {
    //     $user = Auth::user();
    //     $id = Auth::id();
    //     if ($user->type() == 'admin') {
    //         $model->created_by = $id;
    //     } else {
    //         $user = DB::table('areas')->where('admin_id', $id)->select('id')->first();
    //         $model->update_by = $id;
    //         $model->area_id = $user->id;
    //     }
    // }



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
