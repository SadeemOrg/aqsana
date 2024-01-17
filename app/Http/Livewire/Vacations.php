<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\vacation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Vacations extends Component
{
    public $users;
    public $exportWorkHoursErorr = '';
    public $FromDate;
    public $ToDate;
    public $Name;
    public $showEditModel = false;
    public $showAddModel = false;
    public $showNoteModels = false;
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





    public function searchVacation()
    {
        $from = date($this->FromDate);
        $to = date($this->ToDate);
        $this->vacations = vacation::whereBetween('date', [$from, $to])->where("user_id", $this->Name)->orderBy('date', 'ASC')->get();
    }
    public function Delete($id)
    {
        vacation::destroy($id);
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
        if ($this->userId == null) {
            $this->exportWorkHoursErorr = $this->exportWorkHoursErorr . "يجب اختيار الاسم " . '<br>';
        }
        // if ($this->FromDate == null) {
        //     $this->exportWorkHoursErorr =  $this->exportWorkHoursErorr . "يجب اختيار تاريخ البدء " . '<br>';
        // }
        if ($this->date == null) {
            $this->exportWorkHoursErorr = $this->exportWorkHoursErorr . "يجب اختيار تاريخ " . '<br>';
        }
        if ($this->type == null) {
            $this->exportWorkHoursErorr = $this->exportWorkHoursErorr . "يجب اختيار السبب " . '<br>';
        }


        if ($this->type != null && $this->date != null && $this->userId != null) {
            $oldData =  vacation::where('date', $this->date)->where('id', $this->ModelId)->first();


            if ($oldData == null) {


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
                // $this->error = "هذا اليوم موجود مسبقا";
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
