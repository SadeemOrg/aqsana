<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class AlhisalatColect extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public function name()
    {
        return __('حالة السند');
    }
    public $component = 'searchable-select-filter';

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
        switch ($value) {
            case __('الكل'):
                return $query;
            case __('Not Receive yet'):
                return $query->where('transaction_status', '=', 1);
            case __('in a box'):
                return $query->where('transaction_status', '=',2);
            case __('in the bank'):
                return $query->where('transaction_status', '=', 3);
            default:
        }
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
            __('الكل') => __('الكل'),
            __('Not Receive yet') => __('Not Receive yet'),
            __('in a box') =>  __('in a box'),
            __('in the bank') =>  __('in the bank'),

        ];
    }
}
