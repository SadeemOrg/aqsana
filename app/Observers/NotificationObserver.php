<?php

namespace App\Observers;

use App\CPU\Helpers;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Mail\Message;


class NotificationObserver
{
    /**
     * Handle the Notification "created" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */

    
    public function created(Notification $notification)
    {
        
        
            $users = User::all();

            $tokens = [];
            foreach($users as $user){
                
                if($user->fcm_token != null && $user->fcm_token != ""){
                    array_push($tokens,$user->fcm_token);
                    
                }
               
            }

            if(!empty($tokens)){
                Helpers::send_notification($tokens,$notification);
            }
           
          
        
    }

    /**
     * Handle the Notification "updated" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function updated(Notification $notification)
    {
        //
    }

    /**
     * Handle the Notification "deleted" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function deleted(Notification $notification)
    {
        //
    }

    /**
     * Handle the Notification "restored" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function restored(Notification $notification)
    {
        //
    }

    /**
     * Handle the Notification "force deleted" event.
     *
     * @param  \App\Models\Notification  $notification
     * @return void
     */
    public function forceDeleted(Notification $notification)
    {
        //
    }
}
