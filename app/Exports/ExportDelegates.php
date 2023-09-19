<?php

namespace App\Exports;

use App\Models\TelephoneDirectory;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportDelegates implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TelephoneDirectory::whereJsonContains('type', '3')->get();
    }
}
