<?php

namespace App\Nova\Filters;

use App\Models\Area;
use App\Models\SmsType;
use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;

class UserType extends Filter
{

    public function name()
    {
        return __('انواع الموظفين');
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
        if ($value == "non") {
            return $query;
        }
        $SmsType=SmsType::where('name',$value)->first();
        $retVal = (gettype($SmsType->id) == 'integer') ?  (string)$SmsType->id : $SmsType->id;
        return $query->whereJsonContains('type', $retVal);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function options(Request $request)
    {
        $Areas = SmsType::all();
        $foo = array();
        $foo['الكل'] = 'non';
        foreach ($Areas as $Area)
            $foo[$Area->name] = $Area->name;
        return $foo;
    }
}
