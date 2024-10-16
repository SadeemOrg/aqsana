<?php

namespace App\Http\Livewire;

use App\Exports\ExportDonations;
use App\Exports\ExportUsers;
use App\Exports\ExportWorkHours;
use App\Models\User;
use App\Models\WorkHours as ModelsWorkHours;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
    public $sumWorkHourssearch;
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
    public $Timetimetime;
    public $exportWorkHoursErorr = '';
    public $addTime;
    public $TimeleaveTextarea;

    public $exportWorkHoursErorrFromDate='';
    public $exportWorkHoursErorrToDate='';

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
        $this->render();
        $this->hide = 0;
        $user = Auth::user();
        $WorkHours = ModelsWorkHours::where('user_id', '=', $user->id)->whereDate('date', Carbon::today())->first();
        if ($WorkHours == null) {
            ModelsWorkHours::create([
                'user_id' => Auth::id(),
                'day' => Carbon::now()->locale('ar')->dayName,
                'date' => Carbon::now()->toDateTimeString(),
                'start_time' => Carbon::now()->addHour($this->addTime),
                'on_work' => 1,
            ]);
        } else {

            $current = Carbon::now()->addHour($this->addTime);

            if ($WorkHours->departure != null) {
                $array = $WorkHours->departure;
                $array[sizeof($array) - 1]['return_time'] = $current->toDateTimeString();
                $WorkHours->departure = $array;
            }

            $WorkHours->fake_time = Carbon::now()->addHour($this->addTime);
            $WorkHours->on_work = 1;
            $WorkHours->save();
        }
    }
    public function EndWork()
    {
        $this->hide = 1;
        $this->render();


        $user = Auth::user();
        $WorkHours = ModelsWorkHours::where('user_id', '=', $user->id)->whereDate('date', Carbon::today())->first();
        if ($WorkHours != null) {
            // dd($this->realTime);
            $WorkHours->day_hours = $this->realTime;
            $WorkHours->end_time = Carbon::now()->addHour($this->addTime);
            $WorkHours->on_work = 0;
            $WorkHours->fake_time = null;
            $WorkHours->save();
        }

        Auth::logout();
        return redirect('/Admin');
    }
    public function ModelForm()
    {
        $this->hide = 1;
        $this->render();

        $user = Auth::user();
        $WorkHours = ModelsWorkHours::where('user_id', '=', $user->id)->whereDate('date', Carbon::today())->first();
        // dd($this->ModelSelct);
        // dd("de");
        if ($WorkHours->departure == null) {
            $schedule = array();
            $pus = array(
                "Type" => ($this->leaveGoal == "اخرى") ? $this->leaveGoalTextarea : $this->leaveGoal,
                "required_time" => ($this->Timeleave == "اخرى") ? $this->TimeleaveTextarea : $this->Timeleave,
                "required_time" => $this->Timeleave,
                "time_out" => Carbon::now()->addHour($this->addTime)->toDateTimeString(),
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
                "required_time" => $this->Timeleave,
                "time_out" => Carbon::now()->addHour($this->addTime)->toDateTimeString(),
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


        $this->showModel = false;
        Auth::logout();
        return redirect('/Admin');
    }
    public function searchWorkHours()
    {

        $user = Auth::user();
        $this->sersh = 1;
        $from = date($this->FromDate);
        $to = date($this->ToDate);

        $this->WorkHourssearch = ModelsWorkHours::whereBetween('date', [$from, $to])->where('user_id', '=', $user->id)->orderBy('date', 'ASC')->get();
        $string = '2001-01-01 00:00:00.0';
        $date = Carbon::parse($string);
        foreach ($this->WorkHourssearch as $key => $value) {
            if ($value->day_hours != null) {
                $time2 = Carbon::parse($value->day_hours);
                $hours = $time2->hour;
                $minutes = $time2->minute;
                $seconds = $time2->second;

                $date->addSeconds($seconds)->addMinutes($minutes)->addHours($hours);
            }
        }

        $date = Carbon::parse($date);
        // $now = Carbon::now();
        // $diff = $date->diffInDays($now);

        $this->sumWorkHourssearch = $date;
    }
    public function exportWorkHours()
    {
        $user = Auth::id();
        $this->exportWorkHoursErorrFromDate='';
        $this->exportWorkHoursErorrToDate='';

        if ($this->FromDate == null) {
            $this->exportWorkHoursErorrFromDate = "يجب اختيار تاريخ البدء ";
        }
        if ($this->ToDate == null) {
            $this->exportWorkHoursErorrToDate = "يجب اختيار تاريخ  نهاية";
        }
        if (!($this->FromDate == null || $this->ToDate == null)) {

            $this->exportWorkHoursErorr = "";
            return Excel::download(new ExportWorkHours($user, $this->FromDate, $this->ToDate), 'users.xlsx');
        }
    }
    public function stop()
    {
        // $this->hide = 2;
        $this->showModel = !$this->showModel;
    }
    public function closeModel()
    {

        $this->showModel = false;
    }


    public function render()
    {
        $this->addTime = (nova_get_setting('summer_time', '0')) ? 3 : 2;

        $user = Auth::user();
        if ($this->hide == 1) {

            $WorkHours = ModelsWorkHours::where('user_id', '=', $user->id)->whereDate('date', Carbon::today())->first();
            if ($WorkHours != null) {
                if ($WorkHours->on_work != 0) {
                    $this->hide = 0;
                    if ($WorkHours->fake_time != null) {

                        $starttime = Carbon::parse($WorkHours->fake_time);
                        $finishTime = Carbon::now()->addHour($this->addTime);
                        $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
                        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);
                        $days = $startDate->diffInDays($endDate);
                        $this->Hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                        $this->minutes = $startDate->copy()->addDays($days)->addHours($this->Hours)->diffInMinutes($endDate);
                        $this->Seconds = $startDate->copy()->addDays($days)->addHours($this->Hours)->addMinute($this->minutes)->diffInSeconds($endDate);
                        $oldttime = Carbon::parse($WorkHours->day_hours);
                        // dd($oldttime->minute, $this->minutes);
                        $this->Hours += $oldttime->hour;
                        $this->minutes += $oldttime->minute;
                        $this->Seconds += $oldttime->second;
                    } else {
                        // dd("dd");
                        $starttime = Carbon::parse($WorkHours->start_time);
                        $finishTime = Carbon::now()->addHour($this->addTime);
                        $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
                        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);
                        $days = $startDate->diffInDays($endDate);
                        $this->Hours = $startDate->copy()->addDays($days)->diffInHours($endDate);
                        $this->minutes = $startDate->copy()->addDays($days)->addHours($this->Hours)->diffInMinutes($endDate);
                        $this->Seconds = $startDate->copy()->addDays($days)->addHours($this->Hours)->addMinute($this->minutes)->diffInSeconds($endDate);
                    }
                } else {

                    $starttime = Carbon::parse($WorkHours->day_hours);
                    $this->Hours = $starttime->hour;
                    $this->minutes = $starttime->minute;
                    $this->Seconds = $starttime->second;
                    // dd($this->Hours);
                }
            } else {
                $yesterdayWorkHours = ModelsWorkHours::where('user_id', '=', $user->id)->whereDate('date', Carbon::yesterday())->first();
                if ($yesterdayWorkHours != null) {
                    if ($yesterdayWorkHours->end_time == null) {
                        // $this->hide = 0;
                        $yesterdayWorkHours->end_time = "23:59:59";
                        $yesterdayWorkHours->start_time;
                        $startTime = Carbon::parse($yesterdayWorkHours->end_time);
                        $finishTime = Carbon::parse($yesterdayWorkHours->start_time);
                        $totalDuration = $finishTime->diff($startTime)->format('%H:%I:%S');
                        $yesterdayWorkHours->day_hours = $totalDuration;
                        $yesterdayWorkHours->save();
                        // dd(Carbon::now()->minute );



                    }
                } else {
                    $this->Hours = 0;
                    $this->minutes = 0;
                    $this->Seconds = 0;
                }
            }

            $this->Timetimetime = "2014-12-12 0:00:00";
            $this->enterDate = Carbon::createFromFormat('Y-m-d  H:i:s',  $this->Timetimetime);
            $this->enterDate =  $this->enterDate->addHour($this->Hours);
            $this->enterDate =  $this->enterDate->addMinute($this->minutes);
            $this->enterDate =  $this->enterDate->addSecond($this->Seconds);
            $this->realTime =  $this->enterDate->format('H:i:s');
            // dd(  $this->realTime s);
        }



        if ($this->sersh == 0) {
            $currentDateTime = Carbon::now()->addHour($this->addTime);
            $newDateTime = Carbon::now()->addHour($this->addTime)->startOfMonth();
            $this->FromDate = Carbon::now()->startOfMonth()->format('Y-m-d');
            $this->ToDate = Carbon::now()->addHour($this->addTime)->format('Y-m-d');



            $from = date('2022-01-01');
            $to = date('2022-12-31');

            $this->WorkHourssearch = ModelsWorkHours::whereBetween('date', [$newDateTime, $currentDateTime])->where('user_id', '=', $user->id)->orderBy('date', 'ASC')->get();
            $string = '2001-01-01 00:00:00.0';
            $date = Carbon::parse($string);
            foreach ($this->WorkHourssearch as $key => $value) {
                if ($value->day_hours != null) {
                    $time2 = Carbon::parse($value->day_hours);
                    $hours = $time2->hour;
                    $minutes = $time2->minute;
                    $seconds = $time2->second;

                    $date->addSeconds($seconds)->addMinutes($minutes)->addHours($hours);
                }
            }

            $date = Carbon::parse($date);
            // $now = Carbon::now();
            // $diff = $date->diffInDays($now);

            $this->sumWorkHourssearch = $date;
            // dd($this->sumWorkHourssearch );
            // ModelsWorkHours::whereBetween('date', [$newDateTime, $currentDateTime])->where('user_id', '=', $user->id)->get()->dd();
        }
        $this->Reasons_to_stop = nova_get_setting('Reasons_to_stop', 'Reasons_to_stop');
        $this->Reasons_to_stop = json_decode($this->Reasons_to_stop);
        $this->TimeDpartures = nova_get_setting('time_departure', 'Timdepartures');
        $this->TimeDpartures = json_decode($this->TimeDpartures);


        return view('livewire.work-hours');
    }
}
