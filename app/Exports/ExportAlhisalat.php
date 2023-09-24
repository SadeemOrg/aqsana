<?php

namespace App\Exports;

use App\Models\Alhisalat;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportAlhisalat implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Alhisalat::all();
    }
}
