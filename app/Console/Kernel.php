<?php

namespace App\Console;

use App\Services\NotificationService;
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
            $userIds = [1];
            $title = "تذكير قافلة قادمة";
            $body = "";
            $notificationService = new NotificationService();
            $notificationService->sendNotification($userIds, $title, $body);
                })->dailyAt('15:00');
        // $schedule->command('daily:job') ->everyMinute();

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
