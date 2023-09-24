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
use App\Exports\ExportUsers;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class ExportDonations extends Component
{
    public $key;
    public function mount($key)
    {
        $this->key = $key;
    }
    public function Donations()
    {
        return Excel::download(new ExportsExportDonations, 'Donations.csv');
    }

    public function PaymentVoucher()
    {
        return Excel::download(new ExportPaymentVoucher, 'PaymentVoucher.csv');
    }
    public function Address()
    {
        return Excel::download(new  ExportAddress, 'Address.csv');
    }
    public function Alhisalat()
    {
        return Excel::download(new  ExportAlhisalat, 'Alhisalat.csv');
    }
    public function Area()
    {
        return Excel::download(new  ExportAreas, 'Alhisalat.csv');
    }
    public function Delegates()
    {
        return Excel::download(new  ExportDelegates, 'Delegates.csv');
    }
    public function Users()
    {
        return Excel::download(new  ExportUsers, 'Users.csv');
    }
    public function Cites()
    {
        return Excel::download(new  ExportCites, 'Cites.csv');
    }
    public function BusesCompany()
    {
        return Excel::download(new  ExportBusesCompany, 'Company.csv');
    }
    public function render()
    {
        // dd($this->key);


        return view('livewire.export-donations');
    }
}
