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
        return __('ExportReport');
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

        if ($fields-> from==null ||$fields->to ==null) {
            return Action::danger('الرجاء اختيار التاريخ');

        }

        $string = '?reselt=' . $models[0]->id.'&from='.$fields-> from.'&to='.$fields->to;


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
            Date::make(__('from'), 'from')->required(),
            Date::make(__('to'), 'to')->required(),

        ];
    }
}
