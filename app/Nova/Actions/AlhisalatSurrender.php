<?php

namespace App\Nova\Actions;

use App\CPU\Helpers;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class AlhisalatSurrender extends Action
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
        foreach ($models as $model) {
            $model->update([
                'status' => '3',

            ]);
            $users = User::where('user_role', 'financial_user')->get();



            $tokens = [];

            foreach ($users as $key => $user) {

                $notification = Notification::where('id', '5')->first();

                if ($user->fcm_token != null && $user->fcm_token != "") {
                    array_push($tokens, $user->fcm_token);
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
