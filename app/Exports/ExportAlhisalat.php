<?php

namespace App\Exports;

use App\Models\Alhisalat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportAlhisalat implements FromCollection, WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            'العنوان',
            'الاسم',
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        return Alhisalat::all();
    }
    public function map($address): array
    {

        return [
            optional($address->address)->name_address,
            $address->number_alhisala,
        ];
    }
}
