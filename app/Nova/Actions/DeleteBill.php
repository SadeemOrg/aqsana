<?php

namespace App\Nova\Actions;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Actions\ActionResponse;

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
    public function name()
    {
        return __('تعويض');
    }
    public function handle(ActionFields $fields, Collection $models)
    {

        foreach ($models as $model) {

            $largestBillNumber = Transaction::where([
                ['is_delete',  '1'],
            ])
                ->orderBy('bill_number', 'desc')
                ->value('bill_number');
            if (is_null($largestBillNumber)) {
                $largestBillNumber = 999;
            }


            $fieldsTransactionDate = Carbon::parse($fields->transaction_date);
            $modelTransactionDate = $model->transaction_date;

            if ($fieldsTransactionDate->lt($modelTransactionDate)) {
                return Action::danger( 'تاريخ ارجاع السند رقم '.$model->bill_number .' اقل من تاريخ السند');

            }



            $new_data = $model->replicate();
            $new_data-> transact_amount =  -$model->equivelant_amount;
            $new_data->equivelant_amount = -$model->equivelant_amount;
            $new_data->transaction_date = $fields->transaction_date;
            $new_data->payment_reason = $fields->return_money;
            $new_data->bill_number = $largestBillNumber + 1;

            $new_data->is_delete = 2;
            $new_data->description = "تعويض سند رقم " . $model->id;
            $new_data->save();
            $model->update([
                'is_delete' => '1',
                'deleted_ref'=>$new_data->id,
            ]);
        }

        return Action::openInNewTab('/mainbill/'.$new_data->id.'?type=repayment' );
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
            Date::make(__("transaction_date"), "transaction_date")->rules('required'),
            Text::make(__("return money"), "return_money")->rules('required'),
        ];
    }
}
