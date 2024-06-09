<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class AlhisalatStatusFilters extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'searchable-select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function name()
    {
        return __('الحالة');
    }
    public function apply(Request $request, $query, $value)
    {
        if ($value == "الكل") {
            return $query;
        }
        switch ($value) {
            case __('الكل'):
                return $query;
            case __('تم  الوضع '):
                return $query->where('status', '=', 1);
            case __('تم جمع '):
                return $query->where('status', '=', 2);
            case  __('تم التسليم'):
                return $query->where('status', '=', 3);
            case __('تم العد'):
                return $query->where('status', '=', 4);
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
            __('الكل') => 'الكل',
            __('تم  الوضع ') => __('تم  الوضع '),
            __('تم جمع ') => __('تم جمع '),
            __('تم التسليم') => __('تم التسليم'),
            __('تم العد') => __('تم العد'),



        ];
    }
}
