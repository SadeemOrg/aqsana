<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;

class ProjectStatu extends Action
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
            'Project_Status'=>$fields->Project_Status,

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

            Select::make('Project Status ', 'Project_Status')->options([
                'Initial' => 'Initial',
                'Acceptable' => 'Acceptable',
                'project  in progress'=> 'project  in progress',
                'locked' => 'locked',
                'Collection the project' => 'Collection the project',

             ])->displayUsingLabels()
        ];
    }
}
