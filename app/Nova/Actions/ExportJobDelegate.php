<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class ExportJobDelegate extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public  function name()
    {
        return __('Export To Exsel');
    }
    public function handle(ActionFields $fields, Collection $models)
    {
        return Action::openInNewTab('/export/ExportJobDelegate');

    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make(__('jop'), 'jop')->options([
                1 => __('مندوب رئيسي'),
                2 => __('مندوب حصالات'),
                3 => __('مندوب قوافل'),
                4 => __('مساعد مندوب'),
            ])->displayUsingLabels(),
        ];
    }
}
