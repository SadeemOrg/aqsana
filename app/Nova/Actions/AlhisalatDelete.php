<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;

class AlhisalatDelete extends Action
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
        return __('حصالة مفقوده');
    }
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $model->update([
                'status' => '0',

            ]);
            if ($fields->new_alhasele) {
                $new_data = $model->replicate();
                $new_data->status = '1';

                $addresses = DB::table('addresses')->where('id', $model->address_id)->first();
                $countt = $addresses->number + 1;
                $new_data->number_alhisala=  $addresses->name_address . " " . $countt;
                DB::table('addresses')->where('id', $model->address_id)->update(['number' => $countt]);
                // dd( $model->number_alhisala);
                // $new_data->number_alhisala = uniqid();

                $new_data->created_by = '1';
                $new_data->created_at = now();
                $new_data->save();

                // return Action::redirect('/Admin/resources/alhisalats/' . $new_data->id );

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
        return [
            Boolean::make(__("Add new  alhisala"), "new_alhasele")

        ];
    }
}
