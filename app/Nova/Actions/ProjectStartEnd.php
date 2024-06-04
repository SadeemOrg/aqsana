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
    public  function name()
    {
        return __('المشروع');
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


            DB::table('project_status')
                ->where('project_id', $model->id)
                ->update(['status' => DB::raw('status+1'),]);



            if ($model->project_type == '2') {
                TripBooking::where('project_id', $model->id)
                ->update([
                    'status' => '0'
                ]);
                $statu   = DB::table('project_status')
                    ->where('project_id', $model->id)
                    ->first();

                    switch ($model->repetition) {
                        case "1":
                            $newQafel = $model->replicate();
                            $newQafel->start_date->addDays(1);
                            $newQafel->end_date->addDays(1);
                            break;
                        case "2":
                            $newQafel = $model->replicate();
                            $newQafel->start_date->addDays(7);
                            $newQafel->end_date->addDays(7);
                            break;
                        case "3":
                            $newQafel = $model->replicate();
                            $newQafel->start_date->addDays(14);
                            $newQafel->end_date->addDays(14);
                            break;
                        case "4":
                            $newQafel = $model->replicate();
                            $newQafel->start_date->addMonth();
                            $newQafel->end_date->addMonth();
                            break;
                        case "5":
                            $newQafel = $model->replicate();
                            $newQafel->start_date->addYear();
                            $newQafel->end_date->addYear();
                            break;
                        default:
                            // Handle unexpected repetition values
                            break;
                    }

                    if (isset($newQafel)) {
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
