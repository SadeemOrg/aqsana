<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;

class DeleteBill extends Action
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
                'is_delete' => '1',
            ]);


        DB::table('transactions')
        ->Insert(

            [
                'main_type' => '1',
                'type' => '2',
                'ref_id' =>$model->id,
                'Currency' => '3',
                'transact_amount' =>  -$model->transact_amount,
                'equivelant_amount' => -$model->transact_amount,
                'transaction_type' => $model->transaction_type,
                'transaction_status' =>$model->transaction_status,
                "Payment_type"=>'5',
                "lang"=>1,
                'transaction_date' => $fields->transaction_date,
                "is_delete"=>2,
                'description'=>"حذف سند رقم ". $model->id

                ]
            );
        }

    }

    public function icon()
    {
        return 'fa-gear';
    }
    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Date::make(__("transaction_date"), "transaction_date"),
        ];
    }
}
