<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class   ExportDonations implements FromCollection , WithHeadings
{

    public function headings(): array
    {
        return [];
    }
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
