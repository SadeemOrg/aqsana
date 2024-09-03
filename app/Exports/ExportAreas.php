<?php

namespace App\Exports;

use App\Models\Area;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportAreas implements FromCollection, WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            'الاسم',
            'شرح'
        ];
    }

    public function map($address): array
    {

        return [
            $address->name,
            $address->describtion,
            $address->phone_number_address,
        ];
    }

    public function collection()
    {
        return Area::all();
    }
}
