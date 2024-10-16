<?php

namespace App\Nova\Filters;

use App\Models\Area;
use App\Models\City;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class AlhisalatArea extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'searchable-select-filter';
    public function name()
    {
        return __('اللواء');
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

        return $query->whereHas('address', function ($query) use ($value) {
            $query->whereHas('Area', function ($query) use ($value) {
                $Area =Area::where('name',$value)->first();

                $query->where('id', $Area->id);
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
        $Areas = Area::all();
        $foo = array();
        $foo['الكل']='الكل';
        foreach ($Areas as $Area)
        $foo[$Area->name]=$Area->name;
        return $foo;
    }
}
