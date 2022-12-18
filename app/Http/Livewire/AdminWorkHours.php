<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\WorkHours;
use Livewire\Component;
class AdminWorkHours extends Component
{
    public $users;
    public $FromDate;
    public $ToDate;
    public $Name;


    public function sershWorkHours()
    {
        $from = date($this->FromDate);
        $to = date( $this->ToDate);

        $this->WorkHoursLastMAnth = WorkHours::whereBetween('date', [$from, $to])->where("user_id",$this->Name)->get();
        dd( $this->WorkHoursLastMAnth);
    }
    public function render()
    {
        $this->users= User::all();
        return view('livewire.admin-work-hours');
    }
}
