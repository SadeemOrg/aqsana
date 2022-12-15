<?php

namespace App\Http\Livewire;

use App\Models\WorkHours as ModelsWorkHours;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class WorkHours extends Component
{
    public $entrada = '2014-12-12 2:12:00';
    public $realtimw;
    public $hide = 1;
    public $Hours;
    public $minutes;
    public $Seconds;
    public $sersh=0;
    public $WorkHoursLastMAnth;
    public function StartTimerWorkHours()
    {

        $user = Auth::user();
        $WorkHours = ModelsWorkHours::where('user_id', '=', $user->id)->whereDate('date', Carbon::today())->first();

        if ($WorkHours != null) {

            if ($WorkHours->day_hours != null) {
                if ($WorkHours->on_work != 0) {

                    $starttime = Carbon::parse($WorkHours->fake_time);

                    $finishTime = Carbon::now();

                    // $totalDuration = $starttime->diffInHours($finishTime);
                    $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
                    $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);


                    $days = $startDate->diffInDays($endDate);
                    $Hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                    $minutes = $startDate->copy()->addDays($days)->addHours($Hours)->diffInMinutes($endDate);
                    $Seconds = $startDate->copy()->addDays($days)->addHours($Hours)->addMinute($minutes)->diffInMinutes($endDate);
                    $oldttime = Carbon::parse($WorkHours->day_hours);
                    $Hours += $oldttime->hour;
                    $minutes += $oldttime->minute;
                    $Seconds += $oldttime->second;
                    // // $diff_in_hours =   $to->diffInHours($from);
                    dd($startDate, $endDate,   $Hours, $minutes, $Seconds);
                } else {
                    $starttime = Carbon::parse($WorkHours->day_hours);
                    $this->Hours = $starttime->hour;
                    $this->minutes = $starttime->minute;
                    $this->Seconds = $starttime->second;
                    // dd($Hours, $minutes, $Seconds);
                }
            } else {
                $starttime = Carbon::parse($WorkHours->start_time);

                // dd(Carbon::parse($WorkHours[0]->start_time));

                $finishTime = Carbon::now();

                // $totalDuration = $starttime->diffInHours($finishTime);
                $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
                $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);


                $days = $startDate->diffInDays($endDate);
                $this->Hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                $this->minutes = $startDate->copy()->addDays($days)->addHours($Hours)->diffInMinutes($endDate);
                $this->Seconds = $startDate->copy()->addDays($days)->addHours($Hours)->addMinute($minutes)->diffInMinutes($endDate);
                // // $diff_in_hours =   $to->diffInHours($from);
                // $Hours =   $to->diffInHours($from);
                // $minutes =   $to->diffInMinutes($from);
                // $Seconds =   $to->diffInSeconds($from);

                // dd($startDate, $endDate,   $Hours, $minutes, $Seconds);
            }
            // dd( $totalDuration);
        } else {
            $this->Hours = 0;
            $this->minutes = 0;
            $this->Seconds = 0;
            // dd($Hours, $minutes, $Seconds);
        }
        $Timetimetime = "2014-12-12 0:00:00";
        $this->entrada = Carbon::createFromFormat('Y-m-d  H:i:s',  $Timetimetime);
        $this->entrada =  $this->entrada->addHour($this->Hours);
        $this->entrada =  $this->entrada->addMinute($this->minutes);
        $this->entrada =  $this->entrada->addSecond($this->Seconds);
        $this->hide = 0;
    }
    public function sershWorkHours()
    {

    }
    // public function Time()
    // {
    //     $Timetimetime="2014-12-12 0:00:00";
    //     $this->entrada = Carbon::createFromFormat('Y-m-d  H:i:s',  $Timetimetime);

    //     $hower=2;
    //     $minet=1;
    //     $secnd=0;
    //     $this->entrada =  $this->entrada->addHour( $hower);
    //     $this->entrada =  $this->entrada->addMinute( $minet);
    //     $this->entrada =  $this->entrada->addSecond( $secnd);
    //     // dd(( $this->entrada));
    //     // $Timetimetime="2014-12-12 ". $hower.":".$minet.":".$secnd;
    //     $this->hide = 0;


    // }
    public function stop()
    {
        $this->hide = 1;
    }
    public function render()
    {
        if ($this->hide == 0) {
            $this->realtimw =  $this->entrada->addSecond()->format('H:i:s');
        }
        $currentDateTime = Carbon::now();
        $newDateTime = Carbon::now()->subMonth();
        // dd( $currentDateTime, $newDateTime );
        $from = date('2022-01-01');
        $to = date('2022-12-31');

 if ($this->sersh == 0) {
    $this->WorkHoursLastMAnth= ModelsWorkHours::whereBetween('date', [$newDateTime , $currentDateTime])->get();
        }

    //    dd( $WorkHoursLastMAnth);

        return view('livewire.work-hours');
    }
}
