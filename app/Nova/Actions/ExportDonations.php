<?php

namespace App\Nova\Actions;

use Acme\MultiselectField\Multiselect;
use App\Exports\ExportDonations as ExportsExportDonations;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Maatwebsite\Excel\Facades\Excel;

class ExportDonations extends Action
{

    public  function name()
    {
        return __('Export To Exsel');
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

        return Action::openInNewTab('/export/ExportDonations?ref=' . $fields->ref_id . '&&name=' . $fields->name . '&&from=' . $fields->from . '&&to=' . $fields->to);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Multiselect::make(__('project'), "ref_id")
                ->options(function () {
                    $Users =  \App\Models\Project::all();

                    $i = 0;
                    $user_type_admin_array =  array();
                    foreach ($Users as $User) {


                        $user_type_admin_array += [($User['id']) => ($User['project_name'])];
                    }

                    return $user_type_admin_array;
                })
                ->singleSelect(),
            Multiselect::make(__('reference_id'), "name")
                ->options(function () {
                    $Users =  \App\Models\TelephoneDirectory::all();

                    $i = 0;
                    $user_type_admin_array =  array();
                    foreach ($Users as $User) {


                        $user_type_admin_array += [($User['id']) => ($User['name'])];
                    }

                    return $user_type_admin_array;
                })
                ->singleSelect(),
                Date::make(__('from'), 'from'),
                Date::make(__('to'), 'to'),


        ];
    }
}
