<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class AlhisalatStatus extends Action
{
    use InteractsWithQueue, Queueable;
    public  function name ()
    {
        return __('AlhisalatStatusfinsh');
    }
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
                'status' => '2',

            ]);
            $new_data = $model->replicate();
            $new_data->status ='1';
            $new_data->number_alhisala =$fields->number_alhisala;
            $new_data->created_at = now();
            $new_data->save();
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
            Text::make("number alhisala","number_alhisala")
        ];
    }
}
