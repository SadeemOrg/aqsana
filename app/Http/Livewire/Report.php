<?php

namespace App\Http\Livewire;


use App\Exports\ExportAdminWorkHours;
use App\Models\User;
use App\Models\vacation;
use App\Models\WorkHours;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redirect;
use Laravel\Nova\Actions\Action;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Report extends Component
{

    public $users;
    public $FromDate;
    public $ToDate;
    public $Name;
    public $WorkHourssearch;
    public $vacationssearch;
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
    public $notedate = [];
    public $sortedArray = [];
    public $sumWorkHours;
    public $sumVacation;
    public $exportWorkHoursErorrUser = '';
    public $exportWorkHoursErorrDate = '';
    public $exportWorkHoursErorrType = '';


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
                    $this->exportWorkHoursErorrDate =  "يجب اختيار تاريخ البدء " ;
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
    public function searchWorkHours()
    {
        $this->exportWorkHoursErorrUser= "";
        $this->exportWorkHoursErorrDate = "";
        $this->exportWorkHoursErorrType = "";

        if ($this->Name == null ||$this->Name =="null")  {
            $this->exportWorkHoursErorrUser = "يجب اختيار الاسم " ;
        }

        if ($this->FromDate == null) {
            $this->exportWorkHoursErorrDate =  "يجب اختيار تاريخ البدء " ;
        }
        if ($this->ToDate == null) {
            $this->exportWorkHoursErorrType =  "يجب اختيار تاريخ النهاية " ;
        }

        if ($this->FromDate != null && $this->ToDate != null && $this->Name != null) {


            $from = date($this->FromDate);
            $to = date($this->ToDate);
            $tableNameWorkHours = 'work_hours'; // replace with your actual table name
            $tableNameVacations = 'vacations'; // replace with your actual table name


            $workHours = WorkHours::where("user_id", $this->Name)
                ->whereBetween('date', [$from, $to])
                ->orderBy('date', 'ASC')
                ->get();

            $this->sumWorkHours = $workHours->count();
            $workHours = $workHours->toArray();


            // Add the table name to each column in the workHours array
            $workHours = array_map(function ($item) use ($tableNameWorkHours) {
                return array_combine(
                    array_map(function ($key) use ($tableNameWorkHours) {
                        return  $key;
                    }, array_keys($item)),
                    $item
                ) + ['table' => $tableNameWorkHours];
            }, $workHours);


            $vacations = Vacation::where("user_id", $this->Name)
                ->whereBetween('date', [$from, $to])
                ->orderBy('date', 'ASC')
                ->get();

                $vacations = $vacations->map(function ($vacation) {
                    $vacation->days = $vacation->end_date ? $vacation->date->diffInDays($vacation->end_date) + 1 : 1;
                    return $vacation;
                });

                $vacations = $vacations->map(function ($vacation) {
                    $vacation->days = $vacation->end_date
                        ? $vacation->date->diffInDays($vacation->end_date) + 1
                        : 1;
                    return $vacation;
                });
                $vacations = $vacations->map(function ($vacation) {
                    // Calculate vacation days
                    $vacation->days = $vacation->end_date
                        ? $vacation->date->diffInDays($vacation->end_date) + 1
                        : 1;

                    // Calculate total work hours for the vacation period
                    $workHours = WorkHours::whereBetween('date', [$vacation->date, $vacation->end_date])
                                           ->get()->count(); // Assuming there's a 'hours' field in WorkHours

                    $vacation->days -=$workHours;
                    return $vacation;
                });

            $this->sumVacation = $vacations->sum('days');//$vacations->count();
            $vacations = $vacations->toArray();


            // Add the table name to each column in the vacations array
            $vacations = array_map(function ($item) use ($tableNameVacations) {
                return array_combine(
                    array_map(function ($key) use ($tableNameVacations) {
                        return  $key;
                    }, array_keys($item)),
                    $item
                ) + ['table' => $tableNameVacations];
            }, $vacations);


            // Merge the two arrays
            $mergedArray = array_merge($workHours, $vacations);

            // Create a new collection from the merged array
            $mergedCollection = new Collection($mergedArray);

            // Sort the merged collection by the 'date' field
            $sortedCollection = $mergedCollection->sortBy('date');

            // Convert the sorted collection to an array
            $this->sortedArray = $sortedCollection->values()->toArray();
        }
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

        // dd($this->date);
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
    public function showNoteModels($id)
    {

        $EditWorkHours =    WorkHours::find($id);
        $this->Notes = $EditWorkHours->departure;
        $this->notedate = $EditWorkHours->departure;
        $this->ModelId = $id;

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
            // generate-pdf-hours?id=1&FromDate=1/1/2024&ToDate=12/2/2024
            $pdfUrl = '/generate-pdf-hours?id=' . $this->Name . '&FromDate=' . $this->FromDate . '&ToDate=' . $this->ToDate;

            // Redirect to a placeholder page
            $redirectUrl = '/placeholder-page';
            return Redirect::away($pdfUrl)->with(['pdfUrl' => $pdfUrl]);
        }

    }

    public function render()
    {

        $this->users = User::all();
        return view('livewire.report');
    }
}
