<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class PrintBill extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function name()
    {
        return __('طباعة السند');
    }

    public function handle(ActionFields $fields, Collection $models)
    {

        foreach ($models as $model) {
            if ($model->is_delete == 1) {
                return Action::danger('لا يمكن تنفيذ الإجراء لأن السند يحتوي على حالة is_delete == 1');
            }
        }
        $ids = [];
        foreach ($models as $model) {
            $ids[] = $model['id'];
        }

        $idsString = implode(',', $ids);
        return Action::redirect('/generate-pdfs/' . $idsString);

    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
