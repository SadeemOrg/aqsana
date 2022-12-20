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
    public $WorkHourssearch;

    public function sershWorkHours()
    {
        $from = date($this->FromDate);
        $to = date( $this->ToDate);

        $this->WorkHourssearch = WorkHours::whereBetween('date', [$from, $to])->where("user_id",$this->Name)->get();

    }
    public function render()
    {
        $this->users= User::all();
        return view('livewire.admin-work-hours');
    }
}
