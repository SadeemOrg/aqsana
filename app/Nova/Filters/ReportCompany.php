<?php

namespace App\Nova\Filters;

use App\Models\address;
use App\Models\TelephoneDirectory;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ReportCompany extends Filter
{

    public  function name()
    {
        return __('الشركة');
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
        $Company = TelephoneDirectory::where('name', $value)->first();

        return $query->where('name', $Company->id);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $Companies =  \App\Models\TelephoneDirectory::whereJsonContains('type',  '2')->get();
        $address_type_array =  array();
        foreach ($Companies as $Company) {
            $address_type_array += [$Company['name'] => ($Company['name'])];
        }
        return $address_type_array;
    }
}
