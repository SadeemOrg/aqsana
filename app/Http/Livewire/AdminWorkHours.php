<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\WorkHours;
use Carbon\Carbon;
use Livewire\Component;

class AdminWorkHours extends Component
{
    public $users;
    public $FromDate;
    public $ToDate;
    public $Name;
    public $WorkHourssearch;
    public $sumWorkHourssearch;
    public $showEditModel = false;
    public $showAddModel = false;
    public $showNoteModels = false;
    public $ModelId = 0;
    public $EditWorkHours;
    public $date;
    public $start_time;
    public $start_time_Edit;
    public $end_time_Edit;
    public $end_time;
    public $day_hours;
    public $day_hours_off;
    public $userId;
    public $Notes;
    public $error='';

    public $notedate = [];

    public function searchWorkHours()
    {
        $from = date($this->FromDate);
        $to = date($this->ToDate);
        // dd( $from,$to,$this->Name);
        $this->WorkHourssearch = WorkHours::whereBetween('date', [$from, $to])->where("user_id", $this->Name)->orderBy('date', 'ASC')->get();
        //   dd($this->WorkHourssearch );
        $string = '2001-01-01 00:00:00.0';
        $date = Carbon::parse($string);
        // dd($date);
        // $date1->add($date2->diff($date1));
        foreach ($this->WorkHourssearch as $key => $value) {
            if ($value->day_hours != null) {
                $time2 = Carbon::parse($value->day_hours);
                $hours = $time2->hour;
                $minutes = $time2->minute;
                $seconds = $time2->second;

                $date->addSeconds($seconds)->addMinutes($minutes)->addHours($hours);
            }
        }
        // dd($date );
        $date = Carbon::parse($date);
        // $now = Carbon::now();
        // $diff = $date->diffInDays($now);

        $this->sumWorkHourssearch = $date;

        // $formatted = $date->format('H:i:s');
        // dd($this->WorkHourssearch,   $this->sumWorkHourssearch);
        // $this->sumWorkHourssearch = WorkHours::whereBetween('date', [$from, $to])->where("user_id", $this->Name)->sum('day_hours');
        // dd();
    }
    public function showEditModels($id)
    {
        $this->EditWorkHours =    WorkHours::find($id);

        $this->date =Carbon::parse($this->EditWorkHours->date)->format('Y-m-d') ;
        $this->start_time = $this->EditWorkHours->start_time;
        $this->end_time = $this->EditWorkHours->end_time;
        $this->day_hours = $this->EditWorkHours->day_hours;
        $this->ModelId = $id;
        $this->showEditModel = true;
    }

    public function closeEditModel()
    {

        $this->showEditModel = false;
    }
    public function EditDay()
    {

        // dd($this->date);
        $EditWorkHours =    WorkHours::find($this->ModelId);
        $EditWorkHours->date = $this->date;
        $EditWorkHours->start_time = $this->start_time;
        $EditWorkHours->end_time = $this->end_time;
        $EditWorkHours->day_hours = $this->day_hours;
        $EditWorkHours->update();
        // dd($this->ModelId);
        $this->showEditModel = false;
        $this->searchWorkHours();
    }
    public function showAddModels()
    {
        // $this->EditWorkHours =    WorkHours::find($id);
        // $this->date=$this->EditWorkHours->date;
        // $this->start_time= $this->EditWorkHours->start_time;
        // $this->end_time= $this->EditWorkHours->end_time;
        // $this->day_hours= $this->EditWorkHours->day_hours;
        // $this->ModelId=$id;
        $this->showAddModel = true;
    }
    public function closeAddModel()
    {

        $this->showAddModel = false;
    }
    public function AddDay()
    {


      $olddata=  WorkHours::whereDate('date',$this->date)->where('id',$this->ModelId)->first();

        // dd($olddata ==null);
        if ($olddata ==null) {
            $startTime = Carbon::parse($this->start_time);
            $finishTime = Carbon::parse($this->end_time);
            $result =  $finishTime->gt($startTime);

            if ($result) {


        $EditWorkHours = new  WorkHours();
        $EditWorkHours->user_id = $this->ModelId;
        $EditWorkHours->date = $this->date;
        $EditWorkHours->day =  Carbon::parse($this->date)->locale('ar')->dayName;
        $EditWorkHours->start_time = $this->start_time;
        $EditWorkHours->end_time = $this->end_time;

        $totalDuration = $startTime->diff($finishTime)->format('%H:%I:%S');

        $EditWorkHours->day_hours =  $totalDuration;
        $EditWorkHours->save();
        $this->showAddModel = false;
            }
            else {
                $this->error="ساعات البداية اكبر من ساعة النهاية";
            }
    }
    else {
        $this->error="هذا اليوم موجود مسبقا";
    }
    }
    public function showNoteModels($id)
    {

        $EditWorkHours =    WorkHours::find($id);
        $this->Notes = $EditWorkHours->departure;
        $this->notedate = $EditWorkHours->departure;
        $this->ModelId = $id;
        // dd( $this->Notes);
        // $this->date=$this->EditWorkHours->date;
        // $this->start_time= $this->EditWorkHours->start_time;
        // $this->end_time= $this->EditWorkHours->end_time;
        // $this->day_hours= $this->EditWorkHours->day_hours;
        // $this->ModelId=$id;
        $this->showNoteModels = true;
    }
    public function closeNoteModels()
    {

        $this->showNoteModels = false;
    }
    public function EditNote()
    {
        $EditWorkHours =    WorkHours::find($this->ModelId);

        $EditWorkHours->departure = $this->notedate;
        $EditWorkHours->update();
        $this->showNoteModels = false;
    }
    public function DeleteNote($id)
    {
        // dd($id);
        $EditWorkHours =    WorkHours::find($this->ModelId);
        unset($this->notedate[$id]);
        $EditWorkHours->departure = $this->notedate;

        $EditWorkHours->update();
        $this->showNoteModels = false;
    }
    public function Delete($id)
    {
        WorkHours::destroy($id);
        $this->searchWorkHours();
    }
    public function render()
    {
        $this->users = User::all();
        return view('livewire.admin-work-hours');
    }
}
