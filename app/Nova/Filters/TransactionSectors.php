<?php

namespace App\Nova\Filters;

use App\Models\Sector;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class TransactionSectors extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public function name()
    {
        return __('قطاع');
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


        $Sector =Sector::where('text',$value)->first();
        return $query->where('sector',$Sector->id);
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
          $foo[$Sector->text] = $Sector->text;
        return $foo;
    }
}
