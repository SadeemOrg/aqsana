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
use Laravel\Nova\Fields\Text;

class AlhisalatStatuscompleted extends Action
{
    use InteractsWithQueue, Queueable;
    public  function name()
    {
        return __('AlhisalatStatuscompleted');
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
                'status' => '4',

            ]);

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


                if ($fields->new_alhasele) {
                $new_data = $model->replicate();
                $new_data->status ='1';
                $new_data->number_alhisala ='1';
                $new_data->created_by ='1';
                $new_data->created_at = now();
                $new_data->save();

                return Action::redirect('/Admin/resources/alhisalat-amounts/' . $new_data->id . '/edit');
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

            Text::make("alhisala amount", "amount"),
            Boolean::make("Add new  alhisala", "new_alhasele")
        ];
    }
}
