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
use Laravel\Nova\Fields\Select;

class ProjectStatu extends Action
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
            ->select('id')->first();
        foreach ($models as $model) {


        DB::table('project_status')->updateOrInsert(
            [ 'project_id' => $model->id, 'city_id' =>  $citye['id']],
            [ 'status' => $fields->Project_Status  ]
        );
    }

       return action::message('the done');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [

            Select::make('Project Status ', 'Project_Status')->options([
                'Initial' => 'Initial',
                'Acceptable' => 'Acceptable',
                'project  in progress'=> 'project  in progress',
                'locked' => 'locked',
                'Collection the project' => 'Collection the project',

             ])->displayUsingLabels()
        ];
    }
}
