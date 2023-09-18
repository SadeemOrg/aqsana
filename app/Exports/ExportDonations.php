<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportDonations implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transaction::where([
            ['main_type', 1],
            ['type', 2]
        ])->get();
    }
}
