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

    public  function name()
    {
        return __('ApprovalRejectProjec');
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {    $user = Auth::user();
        $id = Auth::id();
        // dd("fkii");
        if ($user->type() == 'regular_city')
        {

        $citye =   City::where('admin_id', $id)
            ->first();
        foreach ($models as $model) {
            DB::table('accept_project')->updateOrInsert(
                ['project_id' => $model->id, 'area_id' =>  $citye['area_id'], 'city_id' =>  $citye['id']],
                ['accepted' => $fields->approval,  'reject_reason' => $fields->reason_of_reject,]
            );
        }
        // if ($fields->approval == "1") {
        //     DB::table('project_status')->updateOrInsert(
        //         ['project_id' => $model->id, 'city_id' =>  $citye['id']],
        //         ['status' => '']
        //     );
        //     // if ($user->type() == 'admin') {
        //     //     DB::table('project_status')->updateOrInsert(
        //     //         ['project_id' => $model->id, 'city_id' =>  $citye['id']],
        //     //         ['status' => ' admin acsept']
        //     //     );
        //     // } elseif ($user->type() == 'regular_area') {
        //     //     DB::table('project_status')->updateOrInsert(
        //     //         ['project_id' => $model->id, 'city_id' =>  $citye['id']],
        //     //         ['status' => 'regular_area acsept']
        //     //     );
        //     // } else if ($user->user_role == "regular_city") {
        //     //     // dd('dd');
        //     //     DB::table('project_status')->updateOrInsert(
        //     //         ['project_id' => $model->id, 'city_id' =>  $citye['id'], 'status' => 'regular_city'],

        //     //     );
        //     // } else if ($user->type() == 'website_admin') {
        //     //     DB::table('project_status')->updateOrInsert(
        //     //         ['project_id' => $model->id, 'city_id' =>  $citye['id']],
        //     //         ['status' => 'website_admin']
        //     //     );
        //     // }
        // } else {
        //     DB::table('project_status')->updateOrInsert(
        //         ['project_id' => $model->id, 'city_id' =>  $citye['id']],
        //         ['status' => 'regect']
        //     );
        // }
    }

//  project_type', '1'

   if ( $models[0]->project_type == '1') {
    if ($fields->approval == "1" ||$user->type() == 'regular_area')    return Action::redirect('/Admin/resources/projects/' . $models[0]->id . '/edit');
       }
       if ( $models[0]->project_type == '2') {
        if ($fields->approval == "1" ||$user->type() == 'regular_area')    return Action::redirect('/Admin/resources/qawafil-alaqsas/' . $models[0]->id . '/edit');
           }
           if ( $models[0]->project_type == '3') {
            if ($fields->approval == "1" ||$user->type() == 'regular_area')    return Action::redirect('/Admin/resources/trips/' . $models[0]->id . '/edit');
               }

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
        $user = Auth::user();

        if($user->type() == 'regular_city')
        {
        return [



            Select::make(__('approval'), 'approval')->options([
                1 => 'approval',
                2 => 'reject',
            ])->displayUsingLabels(),

            NovaDependencyContainer::make([


                Text::make(__('reason_of_reject'), 'reason_of_reject'),


            ])->dependsOn('approval', '2'),




        ];
    }
    else   return [];

    }
}
