<?php

namespace App\Exports;

use App\Models\TelephoneDirectory;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportDelegates implements FromCollection
{

    public function __construct(string $name)
    {
        $this->name = $name;

    }

    public function headings(): array
    {
        return ['id', 'الاسم',  'الايميل', 'رقم الهاتف'];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TelephoneDirectory::whereJsonContains('type', '3')->where('jop',$this->name)->get(['id','name','email','phone_number']);
    }
}
