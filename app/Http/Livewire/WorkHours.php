<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\WorkHours as ModelsWorkHours;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class WorkHours extends Component
{
    public $enterDate = '2014-12-12 2:12:00';
    public $realTime;
    public $hide = 1;
    public $Hours;
    public $minutes;
    public $Seconds;
    public $showModel = false;
    public $leaveGoal;
    public $tags;
    public $sersh = 0;
    public $WorkHourssearch;

    public $FromDate;
    public $ToDate;
    public $Reasons_to_stop;
    public $TimeDpartures;
    public $value;
    public $form;
    public $ModelSelct;
    public $showTable;
    public $showTable2;
    public $Timeleave;
    public $leaveGoalTextarea;
    public function changeEvent($value)
    {
        $this->showTable  = $value;
    }
    public function changeEvent2($value)
    {
        $this->showTable2  = $value;
    }
    public function StartTimerWorkHours()
    {

        $this->hide = 0;
        $user = Auth::user();
        $WorkHours = ModelsWorkHours::where('user_id', '=', $user->id)->whereDate('date', Carbon::today())->first();
        if ($WorkHours == null) {
            ModelsWorkHours::create([
                'user_id' => Auth::id(),
                'day' => Carbon::now()->format('l'),
                'date' => Carbon::now()->toDateTimeString(),
                'start_time' => Carbon::now(),
                'on_work' => 1,
            ]);
        } else {

            $WorkHours->fake_time = Carbon::now();
            $WorkHours->on_work = 1;
            $WorkHours->save();
        }
    }
    public function ModelForm()
    {
        $user = Auth::user();
        $WorkHours = ModelsWorkHours::where('user_id', '=', $user->id)->whereDate('date', Carbon::today())->first();
        if ($this->ModelSelct == 1) {


            $WorkHours->day_hours = $this->realTime;
            $WorkHours->end_time = Carbon::now();
            $WorkHours->on_work = 0;
            $WorkHours->fake_time = null;
            $WorkHours->save();
            Auth::logout();
            return redirect('/Admin');
        }
        if ($this->ModelSelct == 2) {
            // dd($this->Timeleave,$this->leaveGoal,$this->leaveGoalTextarea);
            if ($WorkHours->departure == null) {
                $schedule = array();
                $pus = array(
                    "Type" => ($this->leaveGoal == "اخرى") ? $this->leaveGoalTextarea : $this->leaveGoal,
                    "required_time" =>$this->Timeleave ,
                    "time_out" => Carbon::now(),
                    "return_time" =>  null,
                );

                array_push($schedule, $pus);
                $WorkHours->departure = $schedule;
                $WorkHours->day_hours = $this->realTime;
                $WorkHours->on_work = 0;
                $WorkHours->fake_time = null;
                $WorkHours->save();
            } else {
                $pus = array(
                    "Type" => ($this->leaveGoal == "اخرى") ? $this->leaveGoalTextarea : $this->leaveGoal,
                    "required_time" =>$this->Timeleave ,
                    "time_out" => Carbon::now(),
                    "return_time" =>  null,
                );

                $new =  $WorkHours->departure;
                array_push($new, $pus);

                $WorkHours->departure = $new;
                $WorkHours->day_hours = $this->realTime;
                $WorkHours->on_work = 0;
                $WorkHours->fake_time = null;
                $WorkHours->save();
            }



            Auth::logout();
            return redirect('/Admin');
        }
    }
    public function sershWorkHours()
    {
        $this->sersh = 1;
        $from = date($this->FromDate);
        $to = date($this->ToDate);

        $this->WorkHourssearch = ModelsWorkHours::whereBetween('date', [$from, $to])->get();
    }

    public function stop()
    {
        $this->hide = 2;
        $this->showModel = !$this->showModel;
    }
    public function closeModel()
    {

        $this->showModel = false;
    }

    public function render()
    {


        if ($this->hide == 1) {
            $user = Auth::user();
            $WorkHours = ModelsWorkHours::where('user_id', '=', $user->id)->whereDate('date', Carbon::today())->first();
            if ($WorkHours != null) {
                if ($WorkHours->on_work != 0) {
                    $this->hide = 0;
                    if ($WorkHours->fake_time != null) {

                        $starttime = Carbon::parse($WorkHours->fake_time);
                        $finishTime = Carbon::now();
                        $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
                        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);
                        $days = $startDate->diffInDays($endDate);
                        $this->Hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                        $this->minutes = $startDate->copy()->addDays($days)->addHours($this->Hours)->diffInMinutes($endDate);
                        $this->Seconds = $startDate->copy()->addDays($days)->addHours($this->Hours)->addMinute($this->minutes)->diffInMinutes($endDate);
                        $oldttime = Carbon::parse($WorkHours->day_hours);
                        $this->Hours += $oldttime->hour;
                        $this->minutes += $oldttime->minute;
                        $this->Seconds += $oldttime->second;
                    } else {
                        $starttime = Carbon::parse($WorkHours->start_time);
                        $finishTime = Carbon::now();
                        $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
                        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);
                        $days = $startDate->diffInDays($endDate);
                        $this->Hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                        $this->minutes = $startDate->copy()->addDays($days)->addHours($this->Hours)->diffInMinutes($endDate);
                        $this->Seconds = $startDate->copy()->addDays($days)->addHours($this->Hours)->addMinute($this->minutes)->diffInMinutes($endDate);
                    }
                } else {

                    $starttime = Carbon::parse($WorkHours->day_hours);
                    $this->Hours = $starttime->hour;
                    $this->minutes = $starttime->minute;
                    $this->Seconds = $starttime->second;
                    // dd($this->Hours);
                }
            } else {
                $this->Hours = 0;
                $this->minutes = 0;
                $this->Seconds = 0;
            }
            $Timetimetime = "2014-12-12 0:00:00";
            $this->enterDate = Carbon::createFromFormat('Y-m-d  H:i:s',  $Timetimetime);
            $this->enterDate =  $this->enterDate->addHour($this->Hours);
            $this->enterDate =  $this->enterDate->addMinute($this->minutes);
            $this->enterDate =  $this->enterDate->addSecond($this->Seconds);
            $this->realTime =  $this->enterDate->format('H:i:s');
        }






        if ($this->hide == 0) {
            $this->realTime =  $this->enterDate->addSecond()->format('H:i:s');
        }

        if ($this->sersh == 0) {
            $currentDateTime = Carbon::now();
            $newDateTime = Carbon::now()->subMonth();

            $from = date('2022-01-01');
            $to = date('2022-12-31');

            $this->WorkHourssearch = ModelsWorkHours::whereBetween('date', [$newDateTime, $currentDateTime])->get();


        }
        $this->Reasons_to_stop = nova_get_setting('Reasons_to_stop', 'Reasons_to_stop');
        $this->Reasons_to_stop = json_decode($this->Reasons_to_stop);
        $this->TimeDpartures = nova_get_setting('time_departure', 'Timdepartures');
        $this->TimeDpartures = json_decode($this->TimeDpartures);
        // dd($Reasons_to_stop);

        return view('livewire.work-hours');
    }
}