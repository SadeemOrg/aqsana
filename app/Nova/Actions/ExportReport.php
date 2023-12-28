<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;

class ExportReport extends Action
{
    public  function name()
    {
        return __('Export Excel');
    }
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {

        // ?name=AASAS&email=qqq%40jjf.f&phone=Q&password=ASASA
        $string = '?';
        foreach ($models as $key => $value) {

            $string .= 'reselt' . $key . '=' . $value->id . '&&';
        }
        // dd('/export-form/' .$string);
        return Action::openInNewTab('/export/ExportReport'. $string);

    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Date::make(__('from'), 'from'),
            Date::make(__('to'), 'to'),

        ];
    }
}
