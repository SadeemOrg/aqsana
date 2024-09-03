<?php

namespace App\Exports;

use App\Models\address;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportAddress implements FromCollection, WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            'الاسم',
            'شرح',
            'رقم الهاتف',
            'المدينة',
            'اللواء',
        ];
    }
    public function map($address): array
    {

        return [
            $address->name_address,
            $address->description,
            $address->phone_number_address,
            optional($address->City)->name, // Safely access the 'name' of the related City
            optional($address->Area)->name, // Safely access the 'name' of the related Area
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return address::with(['City', 'Area'])->get();
    }

    /**
     * @param address $address
     * @return array
     */
    public function map($address): array
    {

        return [
            $address->name_address,
            $address->description,
            $address->phone_number_address,
            optional($address->City)->name, // Safely access the 'name' of the related City
            optional($address->Area)->name, // Safely access the 'name' of the related Area
        ];
    }
}
