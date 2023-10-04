<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Anaseqal\NovaImport\Actions\Action;
use App\Imports\TelephoneDirectoryImport as ImportsTelephoneDirectoryImport;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Fields\File;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class TelephoneDirectoryImport extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Indicates if this action is only available on the resource detail view.
     *
     * @var bool
     */
    public $onlyOnIndex = true;
    public function onlyOnIndex($value = true)
    {

        return $value;
    }
    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name() {
        return __('Import Users');
    }

    /**
     * @return string
     */
    public function uriKey() :string
    {
        return 'import-users';
    }

    /**
     * Perform the action.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @return mixed
     */
    public function handle(ActionFields $fields)
    {
        Excel::import(new ImportsTelephoneDirectoryImport, $fields->file);

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
        ];
    }
}
