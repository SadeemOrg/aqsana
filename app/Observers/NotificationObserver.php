<?php

namespace App\Observers;

use App\CPU\Helpers;
use App\Models\Notification;
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
        
        
            $token = "eU1k7vgH1FASnTlH5gZPAr:APA91bHBhNH8P71N6fCKakQFZxH2XaUQkIwl8J6HX0wEb4XGtH84rtU_LQ0ovz0y0uGLqoayq2ax420psis3HkwOMPvF_6rmF9-oMi8q3F2XLw_YdhREL0k0fmWB_qbGHUJiypMJtGeA";  
            Helpers::SendNotification($token,$notification);
          
        
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
