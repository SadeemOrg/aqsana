<?php

namespace App\Nova\Metrics;

use App\Models\TelephoneDirectory;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class DelegateSum extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public  function name ()
    {
        return __('DelegateSum');
    }
    public function calculate(NovaRequest $request)
    {
        // Calculate the count of entries where 'type' JSON field contains '3'
        $count = TelephoneDirectory::whereJsonContains('type', '3')->count();

        // Return the result wrapped in the Nova metric format
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
        return 'delegate-sum';
    }
}
