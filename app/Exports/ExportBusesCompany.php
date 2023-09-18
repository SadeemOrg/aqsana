<?php

namespace App\Exports;

use App\Models\BusesCompany;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBusesCompany implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BusesCompany::all();
    }
}
