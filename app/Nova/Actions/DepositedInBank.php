<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class DepositedInBank extends Action
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
        return __('DepositedInBank');
    }
    public function handle(ActionFields $fields, Collection $models)
    {

        foreach ($models as $model) {

            if ($model->transaction_status == 2) {
                $model->update([
                    'transaction_status' => '3',

                ]);
            }

        }

        return redirect()->back();
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
