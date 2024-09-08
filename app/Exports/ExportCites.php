<?php

namespace App\Exports;

use App\Models\City;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportCites implements FromCollection , WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            'الاسم',
            'اللواء',
        ];
    }
    public function map($address): array
    {

        return [
            $address->name, // Safely access the 'name' of the related City
            optional($address->Area)->name, // Safely access the 'name' of the related Area
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return City::all();
    }
}
