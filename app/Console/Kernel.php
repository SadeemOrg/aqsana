<?php

namespace App\Console;

use Alaqsa\Project\Project;
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
            $tomorrow = Carbon::tomorrow()->toDateString();
            $users = TripBooking::whereHas('Project', function ($query) use ($tomorrow) {
                $query->whereDate('start_date', '=', $tomorrow);
            })->get();

            foreach ($users as $key => $user) {
                $Project=Project::find($user->project_id);
                $title = "تذكير لقافلة الغد";
                $body = "تذكير للقافلة $Project->project_name التي تبدأ غداً.";
                $notificationService = new NotificationService();
                $notificationService->sendNotification([$user->id], $title, $body);
            }


            // Check if there are any users to notify
            // if ($userIds->isNotEmpty()) {
            //     $notificationService = new NotificationService();
            //     $notificationService->sendNotification($userIds->toArray(), $title, $body);
            // }
        })->dailyAt('15:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
