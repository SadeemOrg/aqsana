<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportUsers implements FromCollection , WithHeadings, WithMapping
{
    public function headings(): array
    {
        return [
            'الهوية',
            'الاسم',
            'الايمل   ',
            'رقم الهاتف',
            'تاريخ الميلاد',
        ];
    }
    public function map($user): array
    {

        return [
            $user->id_number,
            $user->name,
            $user->email ,
            $user->phone ,
            $user->birth_date ,

        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
}
