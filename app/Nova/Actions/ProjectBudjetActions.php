<?php

namespace App\Nova\Actions;

use App\Models\City;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;

class ProjectBudjetActions extends Action
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
        $id = Auth::id();
        DB::table('project_status')
        ->where('project_id', $models[0]->id)
        ->update(['status' => 3]);



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
            Text::make("Project Budjet","amount"),
        ];
    }
}