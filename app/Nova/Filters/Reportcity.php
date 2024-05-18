<?php

namespace App\Nova\Filters;

use App\Models\City;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class Reportcity extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public  function name()
    {
        return __('مدينة');
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
        $City =City::where('name',$value)->first();

        return $query->where('city', $City->id);

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
