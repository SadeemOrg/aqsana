<?php

namespace App\Nova\Actions;

use App\Models\City;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;

use Epartment\NovaDependencyContainer\NovaDependencyContainer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Nova;

class ApprovalRejectProjec extends Action
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
                $citye =   City::where('admin_id', $id)
                ->first();
                foreach ($models as $model) {
                    DB::table('accept_project')->updateOrInsert(
                        [ 'project_id' => $model->id, 'area_id' =>  $citye['area_id'],'city_id' =>  $citye['id']],
                        [ 'accepted' => $fields->approval,  'reject_reason' => $fields->reason_of_reject,]
                    );
                }
                if($fields->approval=="1") return Action::redirect('/Admin/resources/projects/'. $models[0]->id .'/edit');
                // Nova::initialPath('/resources/users');
                // return action::message('the done');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [



            Select::make('approval ', 'approval')->options([
                1 => 'approval',
                2=> 'reject',
            ])->displayUsingLabels(),

            NovaDependencyContainer::make([


            Text::make('reason_of_reject','reason_of_reject'),


                ])->dependsOn('approval', '2'),




        ];
    }
}
