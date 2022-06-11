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
class Alhisalat extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $group = 'Admin';


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
        $id = Auth::id();
        $areas = DB::table('areas')->where('admin_id', $id)
        ->join('cities', 'cities.area_id', '=', 'areas.id')
        ->join('alhisalats', 'alhisalats.city_id', '=', 'cities.id')
        ->select('alhisalats.name')->get();
        $stack = array();
      foreach ( $areas as $key => $value) {
          array_push($stack, $value->name);
          // echo $value->name;
      }
        return $query->whereIn('name', $stack);
    }



    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make("Name","name"),
            BelongsTo::make('City','City'),
            Textarea::make("Description","description"),
            Number::make("The amount required","amount_total"),
            Multiselect::make("Status","status")->options([
                '1' => 'placed on the site',
                '2' => 'received',
                '3' => 'Amount completed',
                '4' => 'sent done',
              ])->singleSelect(),
              Text::make("approval","approval")->hideWhenCreating()->
              hideWhenUpdating(),
              Text::make("reason_of_reject","reason_of_reject")->hideWhenCreating()->
              hideWhenUpdating(),
            Number::make("Lat","lat"),
            Number::make("Lon","lon"),

            Text::make("Information location","information_location"),
            DateTime::make('Start time','start_time'),
            DateTime::make('End time','end_time'),




        //     Multiselect::make('Administrator','giver')
        //     ->options( function() {
        //     $users = User::join('user_roles','user_roles.user_id','users.id')
        //     ->join('roles','user_roles.role_id','roles.id')->select('users.name','users.id','roles.role_name')->get();
        //     $user_type_admin_array =  array();

        //     foreach($users as $user) {
        //         $user_type_admin_array += [$user['id'] => ( $user['id'] . $user['name'] . " (". $user['role_name'] .")")];
        //     }

        //     return $user_type_admin_array;
        //    }),



           Multiselect::make('Recipient','recipient')
            ->options( function() {
                 $user_db = User::all();
                 $users =  array();

                foreach($user_db as $user) {
                    $users += [$user['id'] => ($user['name'])];
                }

                return $users;
               })->singleSelect(),

               Multiselect::make('Giver','giver')
            ->options( function() {
                 $user_db = User::all();
                 $users =  array();

                foreach($user_db as $user) {
                    $users += [$user['id'] => ($user['name'])];
                }

                return $users;
               })->singleSelect(),


                HasMany::make('Transaction','giver'),
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
        return [

            (new Actions\ApprovalRejectProjec)->canSee(function ($request) {
                $user = Auth::user();
              return  $user->type() == 'admin';
            }),
        ];
    }
}
