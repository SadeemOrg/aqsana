<?php

namespace App\Nova\Actions;

use Acme\NumberField\NumberField;
use App\Models\Project;
use App\Models\Transaction;
use Carbon\Carbon;
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
        $cityId = null;

        foreach ($models as $model) {
            if (is_null($cityId)) {
                $cityId = $model->address->city_id;
            } elseif ($cityId !== $model->address->city_id) {
                return Action::danger('لا يمكن جمع سندات من مدن مختلفة');
            }
        }

        $currentYear = Carbon::now()->year;
        $Project = Project::where('project_name', 'حصلات ' . $currentYear)->first();


        $array = $models->pluck('number_alhisala')->toArray();
        $stringResult = implode(', ', $array);


        foreach ($models as $model) {
            $model->update([
                'status' => '4',

            ]);
        }
        $largestBillNumber = Transaction::where([
            ['main_type', 1],
            ['type', 2],
            ['is_delete', '<>', '2'],
        ])
            ->orderBy('bill_number', 'desc')
            ->value('bill_number');
        if (is_null($largestBillNumber)) {
            $largestBillNumber = 999;
        }
        DB::table('transactions')
            ->Insert(

                [
                    'main_type' => '1',
                    'type' => '2',
                    'Currency' => '3',
                    'transact_amount' => $fields->amount,
                    'equivelant_amount' => $fields->amount,
                    'transaction_type' => "3",
                    'transaction_status' => "2",
                    "Payment_type" => '5',
                    'payment_reason'=> "حصلات " . " : " .$models[0]->address->City->name,
                    'description' => "حصلات رقم" . " : " . $stringResult,
                    "lang" => 1,
                    'transaction_date' => $date = date('Y-m-d'),
                    'sector' => 11,
                    'ref_id' => $Project?$Project->id:"",
                    'bill_number'=>$largestBillNumber + 1,
                ]
            );


    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [

            NumberField::make(__("alhisala amount"), "amount")->rules('required'),

            // Boolean::make("Add new  alhisala", "new_alhasele")
        ];
    }
}
