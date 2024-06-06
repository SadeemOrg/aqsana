<?php

namespace App\Nova\Filters;

use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Filters\Filter;

class ProjectArea extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'searchable-select-filter';
    public function name()
    {
        return __('ProjectArea');
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

         if($value=="non" )
        { return $query;}
        $projects = DB::table('project_area')->where('area_id', $value)->get();
        $stack = array();
        foreach ($projects as $key => $area) {

            array_push($stack, $area->project_id);

        }


        return $query->wherein('id',$stack);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        // $Areas = Area::all();
        // $foo = array();
        // $foo['الكل']='non';
        // foreach ($Areas as $Area)
        // $foo[$Area->name]=$Area->id;
        // return $foo;
        return [
            'Administrator' => 'admin',
            'Editor' => 'editor',
        ];
    }
}
