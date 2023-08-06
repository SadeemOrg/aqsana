<?php

namespace App\Observers;

use App\Models\Donations;

class DonationsObserver
{
    /**
     * Handle the Donations "created" event.
     *
     * @param  \App\Models\Donations  $donations
     * @return void
     */
    public function created(Donations $donations)
    {

    }

    /**
     * Handle the Donations "updated" event.
     *
     * @param  \App\Models\Donations  $donations
     * @return void
     */
    public function updated(Donations $donations)
    {
        //
    }

    /**
     * Handle the Donations "deleted" event.
     *
     * @param  \App\Models\Donations  $donations
     * @return void
     */
    public function deleted(Donations $donations)
    {
        //
    }

    /**
     * Handle the Donations "restored" event.
     *
     * @param  \App\Models\Donations  $donations
     * @return void
     */
    public function restored(Donations $donations)
    {
        //
    }

    /**
     * Handle the Donations "force deleted" event.
     *
     * @param  \App\Models\Donations  $donations
     * @return void
     */
    public function forceDeleted(Donations $donations)
    {
        //
    }
}
