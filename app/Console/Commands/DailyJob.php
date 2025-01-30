<?php

namespace App\Console\Commands;

use App\Services\NotificationService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DailyJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('users')
            ->where('id', 1)
            ->update([
                'user_number' => DB::raw('COALESCE(user_number, 0) + 1')
            ]);
        $userIds = [1];
        $title = "hellow";
        $body = "hi";
        $notificationService = new NotificationService();
        $notificationService->sendNotification($userIds, $title, $body);
    }
}
