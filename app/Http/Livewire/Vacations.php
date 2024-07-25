<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\vacation;
use App\Models\WorkHours;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Vacations extends Component
{
    public $users;
    public $exportWorkHoursErorr = '';
    public $exportWorkHoursErorrUser = '';
    public $exportWorkHoursErorrDate = '';
    public $exportWorkHoursErorrType = '';
    public $FromDate;
    public $ToDate;
    public $Name;
    public $showEditModel = false;
    public $showAddModel = false;
    public $showNoteModels = false;
    public $showDeleteModel = false;
    public $DeleteVacation = null;
    public $vacations;
    public $WorkHourssearchCount;
    public $EditVacation;
    public $editDate;
    public $editEndDate;
    public $editType;
    public $editNote;
    public $note;
    public $type;
    public $date;
    public $endDate;
    public $ModelId;
    public $userId;
    public $Reasons_to_vacations;
    public $exportWorkHoursErorrUserModel = '';
    public $exportWorkHoursErorrDateModel = '';
    public $exportWorkHoursErorrEndDateModel = '';
    public $exportWorkHoursErorrTypeModel = '';

    public function onChange($type)
    {


        switch ($type) {
            case "name":
                $this->exportWorkHoursErorrUser = '';
                if ($this->Name == null || $this->Name == "null") {
                    $this->exportWorkHoursErorrUser = "يجب اختيار الاسم";
                }
                break;
            case "FromDate":
                $this->exportWorkHoursErorrDate = '';
                // dd("dffd");
                if ($this->FromDate == null || $this->FromDate == "null") {
                    $this->exportWorkHoursErorrDate =  "يجب اختيار تاريخ البدء ";
                }
                break;

            case "ToDate":
                $this->exportWorkHoursErorrType = '';
                if ($this->ToDate  == null || $this->ToDate == "null") {
                    $this->exportWorkHoursErorrType =  "يجب اختيار تاريخ النهاية";
                }
                break;
            default:
                break;
        }
    }
    public function searchVacation()
    {

        $this->exportWorkHoursErorrUser = "";
        $this->exportWorkHoursErorrDate = "";
        $this->exportWorkHoursErorrType = "";

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
        $vacations = Vacation::whereBetween('date', [$from, $to])
            ->where('user_id', $this->Name)
            ->orderBy('date', 'ASC')
            ->get();

        // Calculate the number of days for each vacation
        $this->vacations = $vacations->map(function ($vacation) {
            $vacation->days = $vacation->end_date ? $vacation->date->diffInDays($vacation->end_date) + 1 : 1;
            return $vacation;
        });

        // Retrieve work hours within the given date range
        $workHours = WorkHours::whereBetween('date', [$from, $to])
            ->where('user_id', $this->Name)
            ->orderBy('date', 'ASC')
            ->get();

        // Initialize the work hours count during vacations
        $workHoursDuringVacationCount = 0;

        // Count work hours that fall within each vacation period
        foreach ($vacations as $vacation) {
            $vacationStart = Carbon::parse($vacation->date);
            $vacationEnd = Carbon::parse($vacation->end_date);

            foreach ($workHours as $workHour) {
                $workHourDate = Carbon::parse($workHour->date);

                if ($workHourDate->between($vacationStart, $vacationEnd)) {
                    $workHoursDuringVacationCount++;
                }
            }
        }
        $this->WorkHourssearchCount = $workHoursDuringVacationCount;
    }

    public function DeleteModel($id)
    {
        $this->DeleteVacation =  $id;
        $this->showDeleteModel = true;
    }
    public function closeDeleteModel()
    {

        $this->showDeleteModel = false;
    }
    public function Delete()
    {

        vacation::destroy($this->DeleteVacation);
        $this->showDeleteModel = false;
        $this->searchVacation();
    }

    public function showEditModels($id)
    {
        $this->EditVacation =    vacation::find($id);
        $this->editDate = Carbon::parse($this->EditVacation->date)->format('Y-m-d');
        $this->editEndDate = Carbon::parse($this->EditVacation->end_date)->format('Y-m-d');

        $this->editType = $this->EditVacation->type;
        $this->editNote = $this->EditVacation->note;
        $this->ModelId = $id;

        $this->showEditModel = true;
    }

    public function closeEditModel()
    {

        $this->showEditModel = false;
    }

    public function EditVacation()
    {
        $this->exportWorkHoursErorrDateModel = "";

        $starttime = Carbon::parse($this->editDate);
        $finishTime = Carbon::parse($this->editEndDate);
        $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);
        if (isset($endDate)) {
            if ($endDate->lt($startDate)) {
                $this->exportWorkHoursErorrDateModel =  "تاربج نهاية الاجازة اقل من تاربج بداية الاجازة ";
            }
        }
        if ($this->editType != null && $this->editDate != null && $this->editEndDate != null &&  !($endDate->lt($startDate))) {

            $EditVacation =   vacation::find($this->ModelId);
            $oldData =   Vacation::where('user_id', $EditVacation->user_id)
            ->where('id', '!=', $this->ModelId)
                ->where(function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('date', [$startDate, $endDate])
                        ->orWhereBetween('end_date', [$startDate, $endDate])
                        ->orWhere(function ($query) use ($startDate, $endDate) {
                            $query->where('date', '<=', $startDate)
                                ->where('end_date', '>=', $endDate);
                        });
                })->first();
            if ($oldData == null) {
                $EditVacation->date = $this->editDate;
                $EditVacation->end_date = $this->editEndDate;
                $EditVacation->day = Carbon::parse($this->editDate)->locale('ar')->dayName;
                $EditVacation->type = str_replace('_', ' ', $this->editType);
                $EditVacation->note = $this->editNote;
                $EditVacation->update();

                $this->showEditModel = false;
                $this->searchVacation();
            }
            else{
                $this->exportWorkHoursErorrDateModel = "هذا اليوم موجود مسبقا";

            }
        }
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
        $this->exportWorkHoursErorr = "";
        $this->exportWorkHoursErorrUserModel = "";
        $this->exportWorkHoursErorrDateModel = "";
        $this->exportWorkHoursErorrEndDateModel = "";
        $this->exportWorkHoursErorrTypeModel     = "";
        if ($this->userId == null || $this->userId == "null") {
            $this->exportWorkHoursErorrUserModel = "يجب اختيار الاسم ";
        }

        if ($this->date == null) {
            $this->exportWorkHoursErorrDateModel =  "يجب اختيار تاريخ ";
        }
        if ($this->endDate == null) {
            $this->exportWorkHoursErorrEndDateModel =  " يجب اختيار تاريخ نهاية ";
        }
        if ($this->type == null) {
            $this->exportWorkHoursErorrTypeModel     =  "يجب اختيار السبب ";
        }

        $starttime = Carbon::parse($this->date);
        $finishTime = Carbon::parse($this->endDate);
        $startDate = Carbon::createFromFormat('Y-m-d H:i:s',   $starttime);
        $endDate = Carbon::createFromFormat('Y-m-d H:i:s', $finishTime);
        if (isset($endDate)) {
            if ($endDate->lt($startDate)) {
                $this->exportWorkHoursErorrDateModel =  "تاربج نهاية الاجازة اقل من تاربج بداية الاجازة ";
            }
        }
        if ($this->type != null && $this->date != null && $this->endDate != null && $this->userId != null && !($endDate->lt($startDate))) {
            $oldData =   Vacation::where('user_id', $this->userId)->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate])
                    ->orWhere(function ($query) use ($startDate, $endDate) {
                        $query->where('date', '<=', $startDate)
                            ->where('end_date', '>=', $endDate);
                    });
            })->first();

            if ($oldData == null) {
                $vacation = new vacation();
                $vacation->user_id = $this->userId;
                $vacation->date = $this->date;
                $vacation->end_date = $this->endDate;
                $vacation->day = Carbon::parse($this->date)->locale('ar')->dayName;
                $vacation->type =  str_replace('_', ' ', $this->type);
                $vacation->note = $this->note;
                $vacation->created_by = Auth::id();

                $vacation->save();
                $this->showAddModel = false;

                $this->searchVacation();
            } else {
                $this->exportWorkHoursErorrDateModel = "هذا اليوم موجود مسبقا";
            }
        }
    }
    public function render()
    {
        $this->users = User::all();
        $this->Reasons_to_vacations =  json_decode(nova_get_setting('Reasons_to_vacations', 'Reasons_to_vacations'));
        return view('livewire.vacations');
    }
}
