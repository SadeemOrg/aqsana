<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
        // dd("ee");

        foreach ($models as $model) {
            $model->update([
                'status' => '2',

            ]);
            $new_data = $model->replicate();
            $new_data->status ='1';
            $new_data->number_alhisala =$fields->number_alhisala;
            $new_data->created_by ='1';
            $new_data->created_at = now();
            $new_data->save();

            DB::table('transactions')
            ->Insert(

                [
                    'main_type' => '1',
                    'type' => '1',
                    'ref_id' =>$model->id,
                    'Currency' => '3',
                    'transact_amount' => $fields->amount,
                    'equivelant_amount' =>$fields->amount,
                    'transaction_date' => $date = date('Y-m-d'),
                ]
            );
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
            Text::make("alhisala amount","amount"),
            Text::make("number alhisala","number_alhisala")
        ];
    }
}
