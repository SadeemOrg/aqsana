<?php

namespace App\Nova\Actions;

use App\Models\TripBooking;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class ProjectStartEnd extends Action
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


            DB::table('project_status')
                ->where('project_id', $model->id)
                ->update(['status' => DB::raw('status+1'),]);

            TripBooking::where('project_id', $model->id)
                ->update([
                    'status' => '0'
                ]);

            if ($model->project_type == '2') {

                $statu   = DB::table('project_status')
                    ->where('project_id', $model->id)
                    ->first();
                if ($statu->status == '2') {
                    $newQafel = $model->replicate();

                    if ($model->repetition == "1") {

                        $newQafel->start_date = $newQafel->start_date->addDays('1');
                        $newQafel->end_date = $newQafel->end_date->addDays('1');
                    } elseif ($model->repetition == "2") {

                        $newQafel->start_date = $newQafel->start_date->addDays('7');
                        $newQafel->end_date = $newQafel->end_date->addDays('7');
                    } elseif ($model->repetition == "3") {

                        $newQafel->start_date = $newQafel->start_date->addDays('14');
                        $newQafel->end_date = $newQafel->end_date->addDays('14');
                    } elseif ($model->repetition == "4") {

                        $newQafel->start_date = $newQafel->start_date->addMonth();
                        $newQafel->end_date = $newQafel->end_date->addMonth();
                    } elseif ($model->repetition == "5") {

                        $newQafel->start_date = $newQafel->start_date->addYear();
                        $newQafel->end_date = $newQafel->end_date->addYear();
                    }

                    $newQafel->created_at = Carbon::now();
                    $newQafel->save();
                    DB::table('project_status')->insert([
                        'project_id' => $newQafel->id,
                        'status' => 2,
                    ]);

                }
            }
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
