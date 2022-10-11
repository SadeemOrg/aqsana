<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Image;

class ProjectBillActions extends Action
{
    public  function name()
    {
        return __('Project Bill');
    }
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
        $imageName = time() . '.' . $fields->voucher->extension();
        $fields->voucher->move(public_path('storage'), $imageName);

        DB::table('project_status')
        ->where('project_id', $models[0]->id)
        ->update(['status' => 4]);
        DB::table('transactions')
        ->updateOrInsert(
            ['ref_id' => $models[0]->id],
            [
                'main_type' => '2',
                'type' => '1',
                'Currency' => '3',
                'transact_amount' => $fields->amount,
                'equivelant_amount' => $fields->amount,
                'transaction_date' => $date = date('Y-m-d'),
                'voucher' => $imageName,

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
            Image::make(__('voucher'), 'voucher')->disk('storage')->prunable(),
        ];
    }
}
