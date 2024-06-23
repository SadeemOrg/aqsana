<?php

namespace App\Nova\Actions;

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
        return __('حذف');
    }
    public function handle(ActionFields $fields, Collection $models)
    {

        foreach ($models as $model) {
            // dd($fields->transaction_date, $model->transaction_date);
            $fieldsTransactionDate = Carbon::parse($fields->transaction_date);
            $modelTransactionDate = $model->transaction_date;

            if ($fieldsTransactionDate->lt($modelTransactionDate)) {
                return Action::danger( 'تاريخ ارجاع السند رقم '.$model->bill_number .' اقل من تاريخ السند');

            }

            $model->update([
                'is_delete' => '1',
            ]);

            $new_data = $model->replicate();
            $new_data-> transact_amount =  -$model->transact_amount;
            $new_data->equivelant_amount = -$model->transact_amount;
            $new_data->transaction_date = $fields->transaction_date;
            $new_data->payment_reason = $fields->return_money;

            $new_data->is_delete = 2;
            $new_data->description = "حذف سند رقم " . $model->id;
            $new_data->save();
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
            Date::make(__("transaction_date"), "transaction_date")->rules('required'),
            Text::make(__("return money"), "return_money")->rules('required'),
        ];
    }
}
