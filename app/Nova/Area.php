<?php

namespace App\Nova;

use Acme\MultiselectField\Multiselect;
use App\Nova\Actions\ExportAreas;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Techouse\SelectAutoComplete\SelectAutoComplete as Select;
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

    public static function label()
    {
        return __('Area');
    }
    public static function group()
    {
        return __('address');
    }
    public static function availableForNavigation(Request $request)
    {
        if ((in_array("super-admin",  $request->user()->userrole()) )||(in_array("Areaparmation",  $request->user()->userrole()) )){
            return true;
        }
       else return false;
    }

    public static $model = \App\Models\Area::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';


    public static $priority = 1;


    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id','name'
    ];
    public static function createButtonLabel()
    {
        return 'انشاء لواء';
    }
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
        } else {
            $areas = DB::table('areas')->where('admin_id', $id)
                ->select('areas.name')->get();
            $stack = array();
            foreach ($areas as $key => $value) {

                array_push($stack, $value->name);
            }
            return $query->whereIn('name', $stack);
        }
    }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__('Name'), 'name')->rules('required'),
            Text::make(__('Describtion'), 'describtion')->rules('required'),

            Multiselect::make(__('admin'), 'admin_id')
                ->options(function () {
                    $users =  \App\Models\User::where('user_role', '=', 'regular_area')->get();

                    $user_type_admin_array =  array();

                    foreach ($users as $user) {


                        $user_type_admin_array += [$user['id'] => ($user['name'] . " (" . $user['user_role'] . ")")];
                    }

                    return $user_type_admin_array;
                })->singleSelect()->rules('required'),
            BelongsTo::make(__('admin city'), 'admin', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('created by'), 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
            BelongsTo::make(__('Update by'), 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),


            HasMany::make(__("City"), "City", \App\Nova\City::class),
            HasMany::make(__("ActionEvents"), "ActionEvents", \App\Nova\ActionEvents::class)

        ];
    }

    public static function beforeCreate(Request $request, $model)
    {
        $id = Auth::id();
        $model->created_by = $id;
    }


    public static function beforeUpdate(Request $request, $model)
    {
        $id = Auth::id();
        $model->update_by = $id;
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
        return [
            (new ExportAreas)->standalone()->withoutConfirmation(),

        ];
    }
}
