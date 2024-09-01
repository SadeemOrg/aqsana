<?php

namespace App\Http\Livewire;

use App\Exports\ExportAddress;
use App\Exports\ExportAlhisalat;
use App\Exports\ExportAreas;
use App\Exports\ExportBusesCompany;
use App\Exports\ExportCites;
use App\Exports\ExportDelegates;
use App\Exports\ExportDonations as ExportsExportDonations;
use App\Exports\ExportPaymentVoucher;
use App\Exports\ExportsReport;
use App\Exports\ExportUsers;
use App\Models\Project;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;


class ExportDonations extends Component
{
    public $key;
    public $ref;
    public $name;
    public $from;
    public $to;
    public $type;
    public $dateType;
    public $PaymentType;



    public function mount($key, $ref)
    {
        $this->key = $key;
        $this->ref = $ref;
    }
    public function Donations()
    {

        return Excel::download(new ExportsExportDonations($this->ref, $this->name, $this->from, $this->to), 'Donations.xlsx');
    }
    public function Report()
    {

        $projectNames = Project::whereIn('id', json_decode($this->name))
            ->pluck('project_name')
            ->implode(', ');

        $truncatedProjectNames = Str::limit($projectNames, 30, '');
        $dateToday = Carbon::now()->format('Y-m-d');

        // Construct the filename directly without encoding
        $filename = "{$truncatedProjectNames}_{$dateToday}.xlsx";

        return Excel::download(new ExportsReport($this->name, $this->from, $this->to,$this->dateType,$this->PaymentType), $filename);
    }
    public function PaymentVoucher()
    {
        return Excel::download(new ExportPaymentVoucher, 'PaymentVoucher.xlsx');
    }
    public function Address()
    {
        return Excel::download(new  ExportAddress, 'Address.xlsx');
    }
    public function Alhisalat()
    {
        return Excel::download(new  ExportAlhisalat, 'Alhisalat.xlsx');
    }
    public function Area()
    {
        return Excel::download(new  ExportAreas, 'Alhisalat.xlsx');
    }
    public function Delegates()
    {

        return Excel::download(new  ExportDelegates($this->name), 'Delegates.xlsx');
    }
    public function Users()
    {
        return Excel::download(new  ExportUsers, 'Users.xlsx');
    }
    public function Cites()
    {
        return Excel::download(new  ExportCites, 'Cites.xlsx');
    }
    public function BusesCompany()
    {
        return Excel::download(new  ExportBusesCompany, 'Company.xlsx');
    }
    public function render()
    {
        return view('livewire.export-donations');
    }
}
