<?php

namespace App\Nova;

use App\Models\Area;
use App\Models\City;
use App\Nova\Actions\ProjectBudjetActions;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Pdmfc\NovaFields\ActionButton;

class ProjectBudjet extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static function label()
    {
        return __('project');
    }
    public static function group()
    {
        return __('Financial management');
    }
    public static $model = \App\Models\Project::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];
    public static $priority = 4;
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static function authorizedToCreate(Request $request)
    {
        return false;
    }
    public static function indexQuery(NovaRequest $request, $query)
    {

            $projects = DB::table('project_status')->where('status', '2')->get();

        $stack = array();
        foreach ($projects as $key => $value) {
            array_push($stack, $value->project_id);
        }
        return $query
        // ->whereIn('id', $stack)
        ->where('project_type', '1');
    }
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make(__("project name"), "project_name")->readonly(),
            BelongsToManyField::make(__('Area'), "Area", '\App\Nova\Area')->readonly()->hideFromIndex(),
            BelongsToManyField::make(__('City'), "City", '\App\Nova\City')->readonly()->hideFromIndex(),
            Text::make(__("project describe"), "project_describe")->readonly()->hideFromIndex(),
            Text::make(__('SECTOR'), 'sector')->readonly()->hideFromIndex(),






            ActionButton::make(__('Action'))
            ->action(ProjectBudjetActions::class, $this->id)
            ->text(__('Add budjet'))
            ->showLoadingAnimation()
            ->loadingColor('#fff')
            ->canSee(function(){
                $projects = DB::table('project_status')->where('project_id', $this->id)->first();
            if ( $projects )
            {

                if ($projects->status == '2')  return true;

            }
            }),
            ActionButton::make(__('Action'))
            ->action(ProjectBudjetActions::class, $this->id)
            ->text(__('finished'))
            ->showLoadingAnimation()
            ->loadingColor('#fff')->buttonColor('#21b970')
            ->canSee(function(){
                $projects = DB::table('project_status')->where('project_id', $this->id)->first();
            if ( $projects )
            {
            if ($projects->status == '3')  return true;


            }
            })->readonly(),

            ActionButton::make(__('Action'))
            ->action(ProjectBudjetActions::class, $this->id)
            ->text(__('not finished'))
                        ->showLoadingAnimation()
            ->loadingColor('#fff')->buttonColor('#070707')
            ->canSee(function(){
                $projects = DB::table('project_status')->where('project_id', $this->id)->first();
            if ( $projects )

            {
            if ($projects->status < '2')  return true;


            }
            else return true;

            })->readonly(),


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
            new ProjectBudjetActions,
        ];
    }
}
