<?php

namespace App\Nova\Metrics;

use App\Models\Transaction;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;

class DonationInBox extends Value
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public $refreshWhenActionRuns = true;
    public  function name()
    {
        return __('in a box');
    }
    public function calculate(NovaRequest $request)
    {
        return $this->sum($request, Transaction::where([
            ['transaction_status', 2],
            ['main_type', 1],
        ]), 'equivelant_amount');
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            'ALL' => 'All Time',
            5 => '5 Days',
            10 => '10 Days',
            15 => '15 Days',
            'TODAY' => 'Today',
            'MTD' => 'Month To Date',
            'QTD' => 'Quarter To Date',
            'YTD' => 'Year To Date',

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
        return 'donation-in-box';
    }
}
