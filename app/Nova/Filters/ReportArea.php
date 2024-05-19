<?php

namespace App\Nova\Filters;

use App\Models\Area;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ReportArea extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public  function name()
    {
        return __('لواء');
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
        $Area =Area::where('name',$value)->first();

        return $query->where('area',$Area->id);

    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $Areas = Area::all();
        $foo = array();
        $foo['الكل']='non';
        foreach ($Areas as $Area)
        $foo[$Area->name]=$Area->name;
        return $foo;
    }
}
