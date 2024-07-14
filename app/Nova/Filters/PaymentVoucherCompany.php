<?php

namespace App\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class PaymentVoucherCompany extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'searchable-select-filter';
    public function name()
    {
        return __('الشركة');
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
        $BusesCompany =\App\Models\BusesCompany::where('name',$value)->first();

        return $query->where('name', $BusesCompany->id);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {



        // $Users =  \App\Models\TelephoneDirectory::whereJsonContains('type',  '8')->get();
        // $foo = array();
        // $user_type_admin_array =  array();
        // foreach ($Users as $User) {
        //     $foo[$User['name']]=$User['id'];

        // }
        $foo = array();
        $Users =  \App\Models\BusesCompany::all();
        foreach ($Users as $User) {
            $foo[$User['name']] = $User['name'];
        }
        return $foo;
    }
}
