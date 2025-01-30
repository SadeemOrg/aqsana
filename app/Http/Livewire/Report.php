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

    public function searchWorkHours()
    {
        // Initialize error messages
        $this->exportWorkHoursErorrUser = "";
        $this->exportWorkHoursErorrDate = "";
        $this->exportWorkHoursErorrType = "";

        // Validate inputs
        if ($this->Name == null || $this->Name == "null") {
            $this->exportWorkHoursErorrUser = "يجب اختيار الاسم ";
        }

        if ($this->FromDate == null) {
            $this->exportWorkHoursErorrDate =  "يجب اختيار تاريخ البدء ";
        }

        if ($this->ToDate == null) {
            $this->exportWorkHoursErorrType =  "يجب اختيار تاريخ النهاية ";
        }

        // Proceed if all required parameters are provided
        if ($this->FromDate != null && $this->ToDate != null && $this->Name != null) {

            // Parse the FromDate and ToDate as Carbon instances for easier manipulation
            $from = Carbon::parse($this->FromDate);
            $to = Carbon::parse($this->ToDate);

            // Fetch work hours within the date range
            $workHours = WorkHours::where("user_id", $this->Name)
                ->whereBetween('date', [$from, $to])
                ->orderBy('date', 'ASC')
                ->get();

            $this->sumWorkHours = $workHours->count(); // Count the number of records
            $workHours = $workHours->toArray(); // Convert to an array for further manipulation

            // Add the table name to each column in the workHours array
            $workHours = array_map(function ($item) {
                return $item + ['table' => 'work_hours'];
            }, $workHours);

            // Fetch vacation records within the date range
            $vacations = Vacation::where("user_id", $this->Name)
                ->where(function ($query) use ($from, $to) {
                    $query->whereBetween('date', [$from, $to])
                        ->orWhereBetween('end_date', [$from, $to])
                        ->orWhere(function ($subQuery) use ($from, $to) {
                            $subQuery->where('date', '<', $from)
                                ->where('end_date', '>', $to);
                        });
                })
                ->orderBy('date', 'ASC')
                ->get();

            $vacations = $vacations->map(function ($vacation) use ($to) {
                $vacationStart = Carbon::parse($vacation->date); // Vacation start date
                $vacationEnd = Carbon::parse($vacation->end_date); // Vacation end date

                // If vacation's end_date is greater than $to, update it to $to
                if ($vacationEnd->gt($to)) {

                    $vacation->end_date = $to; // Set end_date to $to
                }

                return $vacation;
            });
            // Assuming you already have the vacations with calculated days
            $vacations = $vacations->map(function ($vacation) use ($from, $to) {
                $vacationStart = Carbon::parse($vacation->date); // Vacation start date
                $vacationEnd = Carbon::parse($vacation->end_date); // Vacation end date

                // If vacation's end_date is greater than $to, update it to $to
                if ($vacationEnd->gt($to)) {
                    $vacation->end_date = $to;
                }
                if ($vacationStart->lt($from)) {
                    $vacation->date = $from;

                    if ($from->isFriday() || $from->isSaturday()) {
                        $from->addDays(7 - $from->dayOfWeek);
                    }

                    $vacation->date = $from;
                    $vacation->day = $from->locale('ar')->isoFormat('dddd');


                }


                // Calculate the number of days between the start and end dates
                if ($vacationEnd->lt($from) || $vacationStart->gt($to)) {
                    $vacation->days = 0; // No overlap with the range
                } else {
                    $vacationOverlapStart = $vacationStart->max($from);
                    $vacationOverlapEnd = $vacationEnd->min($to);
                    $vacation->days = $vacationOverlapStart->diffInDays($vacationOverlapEnd) + 1; // Include both start and end
                }

                return $vacation;
            });

            // Subtract Fridays and Saturdays from the total vacation days
            $totalVacationDays = $vacations->sum('days');

            // Loop through each vacation and adjust the total vacation days by removing Fridays and Saturdays
            $vacations->each(function ($vacation) use (&$totalVacationDays) {
                $vacationStart = Carbon::parse($vacation->date);
                $vacationEnd = Carbon::parse($vacation->end_date);

                // Loop through each day of the vacation period and check for Fridays and Saturdays
                $currentDate = $vacationStart->copy();
                while ($currentDate->lte($vacationEnd)) {
                    if ($currentDate->isFriday() || $currentDate->isSaturday()) {
                        $totalVacationDays--; // Subtract from total if it's a Friday or Saturday
                    }
                    $currentDate->addDay(); // Move to the next day
                }
            });

            // Now $totalVacationDays contains the vacation days with Fridays and Saturdays removed.
            $this->sumVacation = $totalVacationDays;


            // Add the table name to each column in the vacations array
            $vacations = $vacations->map(function ($item) {
                return $item->toArray() + ['table' => 'vacations'];
            });

            // Merge the work hours and vacation records
            $mergedArray = array_merge($workHours, $vacations->toArray());

            // Create a new collection from the merged array and sort by date
            $mergedCollection = new Collection($mergedArray);
            $sortedCollection = $mergedCollection->sortBy('date');

            // Convert the sorted collection to an array and assign it to the class property
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

            $pdfUrl = '/generate-pdf-hours?id=' . $this->Name . '&FromDate=' . $this->FromDate . '&ToDate=' . $this->ToDate;

            // Emit JavaScript to open the URL in a new tab
            $this->dispatchBrowserEvent('open-pdf', ['url' => $pdfUrl]);
            // generate-pdf-hours?id=1&FromDate=1/1/2024&ToDate=12/2/2024
            // $pdfUrl = '/generate-pdf-hours?id=' . $this->Name . '&FromDate=' . $this->FromDate . '&ToDate=' . $this->ToDate;

            // return Redirect::away($pdfUrl)->with(['pdfUrl' => $pdfUrl]);
        }
    }

    public function render()
    {

        $this->users = User::all();
        return view('livewire.report');
    }
}
