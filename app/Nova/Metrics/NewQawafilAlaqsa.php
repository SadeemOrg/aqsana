<?php

namespace App\Nova\Metrics;

use App\Models\City;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class NewQawafilAlaqsa extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public  function name ()
    {
        return __('NewQawafilAlaqsa');
    }
    public function calculate(NovaRequest $request)
    {
        $user = Auth::user();
            $id = Auth::id();
            if ($user->type() == 'admin') {

                return $this->count($request, Project::where('project_type', 2));

            } elseif ($user->type() == 'regular_area') {

                $Area = \App\Models\Area::where('admin_id', $id)->first();
                $projects = DB::table('project_area')->where('area_id', $Area->id)->get();
            } else {
                $citye =   City::where('admin_id', $id)
                    ->select('id')->first();
                $projects = DB::table('project_city')->where('city_id', $citye->id)->get();
            }


            $stack = array();
            foreach ($projects as $key => $value) {
                array_push($stack, $value->project_id);
            }
            return $this->count($request, Project::where('project_type', 2)->whereIn('id', $stack));
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            30 => __('30 Days'),
            60 => __('60 Days'),
            365 => __('365 Days'),
            'TODAY' => __('Today'),
            'MTD' => __('Month To Date'),
            'QTD' => __('Quarter To Date'),
            'YTD' => __('Year To Date'),
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'new-qawafil-alaqsa';
    }
}
