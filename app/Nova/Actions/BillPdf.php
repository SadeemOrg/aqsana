<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class BillPdf extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public  function name()
    {
        return __('معاينة');
    }
    public function handle(ActionFields $fields, Collection $models)
    {
        $urls = [];

        foreach ($models as $model) {
            $urls[] = "/mainbill/" . $model->id;
        }

        return Action::openInNewTab('/open-tabs?' . http_build_query(['urls' => $urls]));
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
