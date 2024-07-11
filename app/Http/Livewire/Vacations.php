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
    public $EditVacation;
    public $editDate;
    public $editType;
    public $editNote;
    public $note;
    public $type;
    public $date;
    public $ModelId;
    public $userId;
    public $Reasons_to_vacations;
    public $exportWorkHoursErorrUserModel = '';
    public $exportWorkHoursErorrDateModel = '';
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
        $this->vacations = vacation::whereBetween('date', [$from, $to])->where("user_id", $this->Name)->orderBy('date', 'ASC')->get();
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


        $EditVacation =   vacation::find($this->ModelId);
        $EditVacation->date = $this->editDate;
        $EditVacation->day = Carbon::parse($this->editDate)->locale('ar')->dayName;
        $EditVacation->type = str_replace('_', ' ', $this->editType);
        $EditVacation->note = $this->editNote;
        $EditVacation->update();

        $this->showEditModel = false;
        $this->searchVacation();
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
        $this->exportWorkHoursErorrTypeModel     = "";

        // dd($this->userId);
        if ($this->userId == null || $this->userId == "null") {
            $this->exportWorkHoursErorrUserModel = "يجب اختيار الاسم ";
        }

        if ($this->date == null) {
            $this->exportWorkHoursErorrDateModel =  "يجب اختيار تاريخ ";
        }
        if ($this->type == null) {
            $this->exportWorkHoursErorrTypeModel     =  "يجب اختيار السبب ";
        }


        if ($this->type != null && $this->date != null && $this->userId != null) {
            $oldData =  vacation::where('date', $this->date)->where('user_id', $this->userId)->first();
            $oldDataWorkHours =  WorkHours::whereDate('date', $this->date)->where('user_id', $this->userId)->first();
            if ($oldData == null) {
                if ($oldDataWorkHours == null) {

                    $vacation = new vacation();
                    $vacation->user_id = $this->userId;
                    $vacation->date = $this->date;
                    $vacation->day = Carbon::parse($this->date)->locale('ar')->dayName;
                    $vacation->type =  str_replace('_', ' ', $this->type);
                    $vacation->note = $this->note;
                    $vacation->created_by = Auth::id();
                    $vacation->save();
                    $this->showAddModel = false;

                    $this->searchVacation();
                } else {

                    $this->exportWorkHoursErorrDateModel = "يوجد دوام في هذا اليوم";
                }
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
