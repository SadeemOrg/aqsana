<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class   ExportDonations implements FromCollection , WithHeadings
{

    public function headings(): array
    {
        return ['العنوان1', 'العنوان2'];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        // Replace this with your data retrieval logic
        return Transaction::find('1081');
        // query()->select('id', 'payment_reason')->get();

    }
}
