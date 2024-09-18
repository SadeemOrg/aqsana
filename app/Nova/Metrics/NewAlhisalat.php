<?php

namespace App\Nova\Metrics;

use App\Models\Alhisalat;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class NewAlhisalat extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public  function name ()
    {
        return __('NewAlhisalat');
    }
    public function calculate(NovaRequest $request)
    {
        $count = Alhisalat::where('status', '=', 1)->count();

        // Return the count result wrapped in Nova's result method
        return $this->result($count);
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {

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
        return 'new-alhisalat';
    }
}
