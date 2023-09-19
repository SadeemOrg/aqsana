<?php

namespace App\Nova\Actions;

use App\Exports\ExportDonations as ExportsExportDonations;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
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

        return   Action::download(url('export/ExportDonations'), 'aaa.xlsx');


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
