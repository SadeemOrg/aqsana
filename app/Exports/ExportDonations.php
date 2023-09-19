<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class   ExportDonations implements FromCollection , WithHeadings
{

    public function headings(): array
    {
        return ['الاسم', 'البريد الإلكتروني'];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Replace this with your data retrieval logic
        return collect([
            ['الاسم', 'البريد الإلكتروني'],
            ['عبد الله', 'abdullah@example.com'],
            ['مريم', 'maryam@example.com'],
        ]);
    }
}
