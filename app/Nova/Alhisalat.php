<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\File;
use Acme\MultiselectField\Multiselect;
use App\Models\User;
use App\Models\Income;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Select;
use Whitecube\NovaGoogleMaps\GoogleMaps;

class Alhisalat extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static function label()
    {
        return __('Alhisalat');
    }

    public static function group()
    {
        return __('project');
    }



    public static $model = \App\Models\Alhisalat::class;
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
        $user = Auth::user();
        $id = Auth::id();
        if($user->type() == 'admin')
        {
            return $query;
        }
        // elseif($user->type() == 'regular_area'){
        // $areas = DB::table('areas')->where('admin_id', $id)
        // ->join('cities', 'cities.area_id', '=', 'areas.id')
        // ->join('alhisalats', 'alhisalats.city_id', '=', 'cities.id')
        // ->select('alhisalats.name')->get();
        // $stack = array();
        // foreach ( $areas as $key => $value) {
        //     array_push($stack, $value->name);
        // }
        // return $query->whereIn('name', $stack);
        // }
     }



    public function fields(Request $request)
    {
        return [



            ID::make(__('ID'), 'id')->sortable(),
            Text::make("Name","name"),
            BelongsTo::make('City','City'),
            BelongsTo::make('address','address'),
            Number::make("number alhisala","number_alhisala"),

            Multiselect::make("Status","status")->options([
                '1' => 'placed on the site',
                '2' => 'received',
                '3' => 'Amount completed',
                '4' => 'sent done',
              ])->singleSelect()->hideWhenCreating()->hideWhenUpdating(),
              BelongsTo::make('created by', 'create', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),
              BelongsTo::make('Update by', 'Updateby', \App\Nova\User::class)->hideWhenCreating()->hideWhenUpdating(),


        ];
    }

    public static function beforeCreate(Request $request, $model)
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
        return [

            (new Actions\ApprovalRejectProjec)->canSee(function ($request) {
                $user = Auth::user();
              return  ($user->type() == 'admin' || $user->type() == 'regular_area');
            }),
        ];
    }
}
