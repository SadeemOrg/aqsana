<?php

namespace App\Nova\Actions;

use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class ApprovalRejectTransaction extends Action
{
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

        foreach ($models as $model) {
            if ($fields->approval == "1") {
                $model->update([
                    'approval' => '1',

                ]);
            }
            if ($fields->approval == "2") {
                $model->update([
                    'approval' => '2',
                    'reason_of_reject' => $fields->reason_of_reject,
                ]);
            }
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [

            Select::make('approval ', 'approval')->options([
                1 => 'approval',
                2 => 'reject',
            ])->displayUsingLabels(),

            NovaDependencyContainer::make([


                Text::make('reason_of_reject', 'reason_of_reject'),


            ])->dependsOn('approval', '2'),
        ];
    }
}
