<?php

namespace App\Nova\Filters;

use App\Models\address;
use App\Models\TelephoneDirectory;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ReportTripFrom extends Filter
{

    public  function name()
    {
        return __('trip from');
    }
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
    public function apply(Request $request, $query, $value)
    {
        $address = address::where('name_address', $value)->where('type', '1')->first();

        return $query->where('trip_from', $address->id);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $addresses =  address::where('type', '1')->get();
        $address_type_array =  array();
        foreach ($addresses as $address) {
            $address_type_array += [$address['name_address'] => ($address['name_address'])];
        }

        return $address_type_array;
    }
}
