<?php

namespace App\Http\Livewire;

use App\Exports\ExportAdminWorkHours;
use App\Models\User;
use App\Models\WorkHours;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

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
    public $error = '';
    public $exportWorkHoursErorr = '';
    public $exportWorkHoursErorrUser = '';
    public $exportWorkHoursErorrDate = '';
    public $exportWorkHoursErorrType = '';
    public $exportWorkHoursErorrUserModel = '';
    public $exportWorkHoursErorrDateModel = '';
    public $exportWorkHoursErorrTypeModel = '';
    public $dateErorrUser = '';
    public $startTimeErorr = '';
    public $endTimeWorkHoursErorr = '';
    public $ModelIdErorrUser = '';
    public $notedate = [];
    public $stop = 0;


    public function searchWorkHours()
    {

        $this->exportWorkHoursErorrUser = "";
        $this->exportWorkHoursErorrDate = "";
        $this->exportWorkHoursErorrType = "";

        // dd($this->userId);
        if ($this->Name == null || $this->Name == "null") {
            $this->exportWorkHoursErorrUser = "يجب اختيار الاسم ";
        }

        if ($this->FromDate == null) {
            $this->exportWorkHoursErorrDate =  "يجب اختيار تاريخ البدء ";
        }
        if ($this->ToDate == null) {
            $this->exportWorkHoursErorrType =  "يجب اختيار تاريخ النهاية ";
        }
        $from = date($this->FromDate);
        $to = date($this->ToDate);
        $this->WorkHourssearch = WorkHours::whereBetween('date', [$from, $to])->where("user_id", $this->Name)->orderBy('date', 'ASC')->get();
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

        $this->sumWorkHourssearch = $date;
    }
    public function showEditModels($id)
    {
        $this->EditWorkHours =    WorkHours::find($id);

        $this->date = Carbon::parse($this->EditWorkHours->date)->format('Y-m-d');
        $this->start_time = Carbon::parse($this->EditWorkHours->start_time)->format('H:i');
        $this->end_time = Carbon::parse($this->EditWorkHours->end_time)->format('H:i');
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



        $startTime = Carbon::parse($this->start_time);
        $finishTime = Carbon::parse($this->end_time);
        $EditWorkHours =    WorkHours::find($this->ModelId);
        $EditWorkHours->date = $this->date;
        $EditWorkHours->start_time = $this->start_time;
        $EditWorkHours->end_time = $this->end_time;
        $EditWorkHours->day_hours = $startTime->diff($finishTime)->format('%H:%I:%S');
        $EditWorkHours->update();
        // dd($this->ModelId);
        $this->showEditModel = false;
        $this->searchWorkHours();
    }
    public function showAddModels()
    {

        $this->showAddModel = true;
    }
    public function closeAddModel()
    {

        $this->showAddModel = false;
    }
    public function AddDay()
    {

        $this->ModelIdErorrUser = "";
        $this->dateErorrUser = "";
        $this->startTimeErorr = "";
        $this->endTimeWorkHoursErorr = "";
        $this->stop =0;
        // dd($this->userI
        if ($this->ModelId == null) {
            $this->ModelIdErorrUser = "يجب اختيار الاسم ";
            $this->stop = 1;
        }
        if ($this->date == null) {
            $this->dateErorrUser = "يجب اختيار التاريخ ";
            $this->stop = 1;
        }

        if ($this->start_time == null) {
            $this->startTimeErorr =  "يجب اختيار ساعة البدء ";
            $this->stop = 1;
        }
        if ($this->end_time == null) {
            $this->endTimeWorkHoursErorr =  "يجب اختيار ساعة النهاية ";
            $this->stop = 1;
        }

        if ($this->stop == 0) {

            $olddata =  WorkHours::whereDate('date', $this->date)->where('id', $this->ModelId)->first();

            // dd($olddata ==null);
            if ($olddata == null) {
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
                } else {
                    $this->error = "ساعات البداية اكبر من ساعة النهاية";
                }
            } else {
                $this->error = "هذا اليوم موجود مسبقا";
            }
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

    public function exportWorkHours()
    {
        $this->exportWorkHoursErorr = "";
        if ($this->Name == null) {
            $this->exportWorkHoursErorr = $this->exportWorkHoursErorr . "يجب اختيار الاسم " . '<br>';
        }
        if ($this->FromDate == null) {
            $this->exportWorkHoursErorr =  $this->exportWorkHoursErorr . "يجب اختيار تاريخ البدء " . '<br>';
        }
        if ($this->ToDate == null) {
            $this->exportWorkHoursErorr = $this->exportWorkHoursErorr . "يجب اختيار تاريخ النهاية" . '<br>';
        }

        if ($this->FromDate != null && $this->ToDate != null && $this->Name != null) {
            return Excel::download(new ExportAdminWorkHours($this->Name, $this->FromDate, $this->ToDate), 'users.xlsx');
            $this->exportWorkHoursErorr = "";
        }
    }

    public function render()
    {
        $this->users = User::all();
        return view('livewire.admin-work-hours');
    }
}
