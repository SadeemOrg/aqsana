<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class PaymentType extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'searchable-select-filter';
    public function name()
    {
        return __('طريقة الدفع');
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
        return $query->where('Payment_type',$value);
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

            __('cash') => '1',
            __('shek') => '2',
            __('bit') => '3',
            __('hawale') => '4',
            __('pay pal') => '5',
            __('حصالة') => '6'
        ];
    }
}
