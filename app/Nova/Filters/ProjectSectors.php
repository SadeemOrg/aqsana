<?php

namespace App\Nova\Filters;

use App\Models\Sector;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ProjectSectors extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'searchable-select-filter';

    // public $component = 'select-filter';

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
// dd($query->where('area_id',$value)->get());
        return $query->where('sector',$value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $Sectors = Sector::all();
        $foo = array();
        foreach ($Sectors as $Sector)
            $foo[$Sector->text] = $Sector->id;
        return $foo;
    }
}
