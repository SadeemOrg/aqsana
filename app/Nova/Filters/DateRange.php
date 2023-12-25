<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use Ampeco\Filters\DateRangeFilter;
use Carbon\Carbon;
use R64\Filters\DateFilter;

class DateRange extends DateFilter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(Request $request, $query, $value)
    {
        $from = Carbon::parse($value[0])->startOfDay();
        $to = Carbon::parse($value[1])->endOfDay();

        return $query->whereBetween('created_at', [$from, $to]);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        return [
            'dateFormat' => 'Y-m-d', // default Y-m-d H:i:S
            'placeholder' => 'My placeholder', // default __('Pick a date')
            'disabled' => true, // default false
            'twelveHourTime' => true, // default false
            'enableTime' => true, // default false
            'enableSeconds' => true, // default false
          ];
    }
}
