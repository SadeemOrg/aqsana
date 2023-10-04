<?php

namespace App\Nova\Actions;

use Acme\MultiselectField\Multiselect;
use App\Imports\TelephoneDirectoryImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Maatwebsite\Excel\Facades\Excel;

class ImportTelephoneDirectory extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;
      /**
     * Indicates if this action is only available on the resource detail view.
     *
     * @var bool
     */
    public $onlyOnIndex = true;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name() {
        return __('استيراد xlsx');
    }

    /**
     * @return string
     */
    public function uriKey() :string
    {
        return 'import-users';
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

        Excel::import(new TelephoneDirectoryImport($fields->type), $fields->file);

        return Action::message('It worked!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            File::make('File')
                ->rules('required'),
                Multiselect::make(__('type'), 'type')
                ->options(function () {
                    $Areas =  \App\Models\SmsType::all();

                    $Area_type_admin_array =  array();

                    foreach ($Areas as $Area) {


                        $Area_type_admin_array += [$Area['id'] => ($Area['name'])];
                    }

                    return $Area_type_admin_array;
                })->saveAsJSON(),
        ];
    }
}
