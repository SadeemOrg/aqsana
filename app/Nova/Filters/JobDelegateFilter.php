<?php

namespace App\Nova\Filters;

use App\Models\Area;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class JobDelegateFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'searchable-select-filter';
    public function name()
    {
        return __('jop');
    }
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
        return $query->where('jop',$value);
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

            __('مندوب رئيسي') => 1,
            __('مندوب حصالات') => 2,
            __('مندوب قوافل') => 3,
            __('مساعد مندوب') => 4,
        ];
    }
}
