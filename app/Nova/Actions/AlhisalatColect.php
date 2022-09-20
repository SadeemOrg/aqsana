<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class AlhisalatColect extends Action
{
    use InteractsWithQueue, Queueable;
    public  function name()
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
        // dd("ee");

        foreach ($models as $model) {


                $model->update([
                    'status' => '2',
                ]);
                if ($fields->new_alhasele) {
                    $new_data = $model->replicate();
                    $new_data->status = '1';
                    $new_data->number_alhisala = uniqid();
                    $new_data->created_by = '1';
                    $new_data->created_at = now();
                    $new_data->save();

                    return Action::redirect('/Admin/resources/alhisalats/' . $new_data->id . '/edit');

            }
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
            // Text::make("alhisala amount","amount"),
            // Text::make("number alhisala","number_alhisala")
            Boolean::make("Add new  alhisala", "new_alhasele")
        ];
    }
}
