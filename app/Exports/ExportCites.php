<?php

namespace App\Exports;

use App\Models\City;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportCites implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return City::all();
    }
}
