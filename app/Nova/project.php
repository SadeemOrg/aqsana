<?php

namespace App\Nova;
use App\Models\Area;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Acme\MultiselectField\Multiselect;
use App\Nova\Actions\ApprovalRejectProjec;
use App\Nova\Actions\ProjectStatu;
use Illuminate\Support\Facades\Auth;
use App\Nova\Filters\ProjectStatus;
use App\Nova\Filters\Projectapproval;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class project extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\project::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static $group = 'Admin';

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
    // public static function indexQuery(NovaRequest $request, $query)
    // {
    //     $id = Auth::id();
    //     $areas = DB::table('areas')->where('admin_id', $id)
    //     ->join('projects', 'projects.area_id', '=', 'areas.id')
    //     ->select('alhisalats.name')->get();
    //     $stack = array();
    //   foreach ( $areas as $key => $value) {
    //       array_push($stack, $value->name);
    //       // echo $value->name;
    //   }
    //     return $query->whereIn('name', $stack);
    // }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make("project_name","project_name"),
            Number::make("project_number","project_number"),
            Select::make('admin','admin_id',)
            ->options( function() {
                $users =  \App\Models\User::where('user_roll', '=', 'admin')->get();

                $user_type_admin_array =  array();

                foreach($users as $user) {
                    $user_type_admin_array += [$user['id'] => ($user['name'] . " (". $user['user_roll'] .")")];
                }

                return $user_type_admin_array;
               }),
            Text::make("project_goal","project_goal"),
            Text::make("projec_type","projec_type"),
            Select::make('Project Status ', 'Project_Status')->options([
                'Initial' => 'Initial',
                'Acceptable' => 'Acceptable',
                'project  in progress'=> 'project  in progress',
                'locked' => 'locked',
                'Collection the project' => 'Collection the project',

             ])->displayUsingLabels()->hideWhenCreating()->
             hideWhenUpdating(),

             Text::make("approval","approval")->hideWhenCreating()->
             hideWhenUpdating(),
             Text::make("reason_of_reject","reason_of_reject")->hideWhenCreating()->
             hideWhenUpdating(),
            DateTime::make('End time','projec_start'),
            DateTime::make('projec_end','projec_end'),
            Multiselect::make('city','city_id')
            ->options( function() {
            $buses_db = City::all();
            $buses =  array();

            foreach($buses_db as $bus) {
            $buses += [$bus['name'] => ($bus['name'])];
            }

            return $buses;
            })
            ->saveAsJSON(),

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
        return [
            new ProjectStatus,
            new  Projectapproval
        ];
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

             (new ApprovalRejectProjec)->canSee(function ($request) {
                $user = Auth::user();
              return  $user->type() == 'admin';
            }),
             new ProjectStatu,

        ];
    }
}
