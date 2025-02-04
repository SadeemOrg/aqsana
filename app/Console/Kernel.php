<?php

namespace App\Console;

use App\Models\TripBooking;
use App\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\ProjectStartEnd::class,
        \App\Console\Commands\DailyJob::class,

    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('Project:StartEnd')
        // ->everyMinute();

        $schedule->call(function () {
            // Get the date for tomorrow
            $tomorrow = Carbon::tomorrow()->toDateString();

            // Get users who have booked a trip where the related project start_date is tomorrow
            $userIds = TripBooking::whereHas('Project', function ($query) use ($tomorrow) {
                $query->whereDate('start_date', '=', $tomorrow);
            })
            ->pluck('user_id'); // Extract the user IDs

            $title = "تذكير قافلة قادمة";
            $body = "هذه تذكرة تذكير للقافلة القادمة التي تبدأ غداً.";

            // Check if there are any users to notify
            if ($userIds->isNotEmpty()) {
                $notificationService = new NotificationService();
                $notificationService->sendNotification($userIds->toArray(), $title, $body);
            }
        })->dailyAt('15:00');

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
