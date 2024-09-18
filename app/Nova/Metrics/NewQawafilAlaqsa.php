<?php

namespace App\Nova\Metrics;

use App\Models\City;
use App\Models\Project;
use Carbon\Carbon;
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
    public  function name()
    {
        return __('NewQawafilAlaqsa');
    }
    public function calculate(NovaRequest $request)
    {
        $nowTime = Carbon::now();

        // Fetch projects and apply the filter
        $projects = Project::where('project_type', 2)
            ->get()  // First, fetch the projects
            ->filter(function ($project) use ($nowTime) {
                $startTime = Carbon::parse($project->start_date);
                $endTime = Carbon::parse($project->end_date);

                // Return true if current time is between start and end dates
                return ($startTime->lt($nowTime) && $nowTime->lt($endTime)) || ($startTime->gt($nowTime));
            }) ->unique('project_name');

        // Return the count of filtered projects
        return $this->result($projects->count());
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
