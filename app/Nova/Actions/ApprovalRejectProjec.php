<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;

use Epartment\NovaDependencyContainer\NovaDependencyContainer;

class ApprovalRejectProjec extends Action
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
                 $model->update([
                 'approval'=>$fields->approval,
                  'reason_of_reject'=>$fields->reason_of_reject
             ]);
            }

            return action::message('the done');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            // Text::make('approval ', 'approval'),
            Select::make('approval ', 'approval')->options([
                "approval" => 'approval',
                "reject"=> 'reject',
            ])->displayUsingLabels(),

            NovaDependencyContainer::make([


            Text::make('reason_of_reject','reason_of_reject'),


                ])->dependsOn('approval', 'reject'),



        ];
    }
}
