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
        if($value=="non" )
        { return $query;}
        return $query->where('transaction_status','=',$value);
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
            __('all') => 'non',
            __('Not Receive yet') => 1,
            __('in a box') => 2,
            __('in the bank') => 3,

        ];
    }
}
