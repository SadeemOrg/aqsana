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
        switch($value) {
            case __('cash'):
                return $query->where('Payment_type',1);
                break;
            case __('shek'):
                return $query->where('Payment_type',2);
                break;
            case __('bit'):
                return $query->where('Payment_type',3);
                break;
            case __('hawale'):
                return $query->where('Payment_type',4);
                break;
            case __('حصالة'):
                return $query->where('Payment_type',5);
                break;
            default:
                return __('Unknown payment method');
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

            __('cash') => __('cash'),
            __('shek') =>  __('shek') ,
            __('bit') => __('bit'),
            __('hawale') => __('hawale'),
            __('pay pal') => __('pay pal'),
            __('حصالة') =>  __('حصالة')
        ];
    }
}
