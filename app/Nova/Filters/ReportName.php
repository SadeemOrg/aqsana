<?php

namespace App\Nova\Filters;

use App\Models\Project;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class ReportName extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public  function name()
    {
        return __('اسم المشروع');
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


        return $query->where('project_name', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $Projects= Project::all();
        $foo = array();
        $foo['الكل']='non';
        foreach ($Projects as $Project)
        $foo[$Project->project_name]=$Project->project_name;
        return $foo;
    }
}
