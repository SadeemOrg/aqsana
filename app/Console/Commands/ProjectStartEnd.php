<?php

namespace App\Console\Commands;

use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectStartEnd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Project:StartEnd';

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


        $start = Carbon::today();
        $end = Carbon::today()->addDays(0);
            $startprojects = DB::table('projects')
        ->where([
                ['start_date', '<' ,$start],
                ['end_date', '>' ,$end],
            ])

        ->get();
        $endprojects = DB::table('projects')
        ->where([
                ['start_date', '<' ,$start],
                ['end_date', '<' ,$end],
            ])

        ->get();
        foreach ($startprojects as  $startproject) {
            DB::table('project_status')
            ->where('project_id', $startproject->id)
            ->update(['status' => 1]);
        }
        foreach ($endprojects as  $endtproject) {
            DB::table('project_status')
            ->where('project_id', $endtproject->id)
            ->update(['status' => 2]);
        }
    }
}
