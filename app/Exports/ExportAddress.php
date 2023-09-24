<?php

namespace App\Exports;

use App\Models\address;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportAddress implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return address::all();
    }
}
