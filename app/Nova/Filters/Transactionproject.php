<?php

namespace App\Nova\Filters;

use App\Models\Project;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class Transactionproject extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public function name()
    {
        return __('مشروع');
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
        return $query->where('ref_id',$value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $Projects = Project::all();
        $foo = array();
        foreach ($Projects as $Projec)
            $foo[$Projec->project_name] = $Projec->id;
        return $foo;
    }
}
