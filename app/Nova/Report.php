<?php

namespace App\Nova;

use App\Models\Project;
use App\Models\Transaction;
use App\Nova\Actions\ExportReport;
use App\Nova\Filters\DateRange;
use App\Nova\Filters\ProjectSectors;
use App\Nova\Metrics\NetProject;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Nemrutco\NovaGlobalFilter\NovaGlobalFilter;
use PosLifestyle\DateRangeFilter\DateRangeFilter;
use Upline\RowBackground\RowBackground;
use Upline\RowBackground\RowBackgroundData;

class Report extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */

    public static $model = \App\Models\Project::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';
    public static function label()
    {
        return __('Report');
    }
    public static function group()
    {
        return __('Financial management');
    }
    public function authorizedToDelete(Request $request)
    {
        return false;
    }
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'project_name'
    ];


    public static function authorizedToCreate(Request $request)
    {
        return false;
    }
    public function authorizedToReplicate(Request $request)
    {
        return false;
    }
    public function authorizedToUpdate(Request $request)
    {

        return false;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        foreach ($query->get() as $q) {
            $in_come = Transaction::where('main_type', '1')->where('ref_id', $q->id)->sum('equivelant_amount');
            $out_come = Transaction::where('main_type', '2')->where('ref_id', $q->id)->sum('equivelant_amount');
            $Net_in_come = $in_come - $out_come;
            Project::where('id', $q->id)->update(['out_come' => $out_come, 'in_come' => $in_come, 'Net_in_come' => $Net_in_come]);
        }
    }
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [

            ID::make(__('ID'), 'id')->calculate('count', __('Total Count')),
            Text::make(__("project name"), "project_name")->rules('required'),
            BelongsTo::make(__('Sector'), 'Sectors', \App\Nova\Sector::class)->nullable()->hideWhenCreating()->hideWhenUpdating(),

            Text::make(__("receipt Voucher"), "in_come")->calculate('sum', __('Total Count')),

            Text::make(__("Out Come"), "out_come")->calculate('sum', __('Total Count')),

            Text::make(__("Net"), "Net_in_come")->calculate('sum', __('Total Count')),


            RowBackground::make(__("Net In Come"), "Net_in_come", function ($model) {
                if($this->Net_in_come<0){
                    return new RowBackgroundData("#ff0000", "#ffffff");
                }

            })->onlyOnIndex(),
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
            new ProjectSectors,
            new DateRangeFilter(__("start"),"start_date"),
            new DateRangeFilter(__("end"),"end_date"),


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
            (new ExportReport())->standalone(),
        ];
    }
}