<?php

namespace App\Nova\Filters;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ReportAdmin extends Filter
{

    public  function name()
    {
        return __('Project Officer');
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
        return $query->where('admin_id',$value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $users =  \App\Models\TelephoneDirectory::whereJsonContains('type',  '3')->get();
        $user_type_admin_array =  array();
        foreach ($users as $user) {
            $user_type_admin_array += [$user['name'] => ($user['id'])];
        }

        return $user_type_admin_array;

    }
}
