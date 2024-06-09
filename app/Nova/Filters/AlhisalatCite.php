<?php

namespace App\Nova\Filters;

use App\Models\City;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class AlhisalatCite extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'searchable-select-filter';
    public function name()
    {
        return __('المدينة');
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
        // return $query;

        return $query->whereHas('address', function ($query) use ($value) {
            $query->whereHas('City', function ($query) use ($value) {
                $City =City::where('name',$value)->first();

                $query->where('id', $City->id); // Adjust the column name as needed
            });
        });
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $Areas = City::all();
        $foo = array();
        $foo['الكل']='non';
        foreach ($Areas as $Area)
        $foo[$Area->name]=$Area->name;
        return $foo;
    }
}
