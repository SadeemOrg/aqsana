<?php

namespace App\Imports;

use App\Models\TelephoneDirectory;
use Maatwebsite\Excel\Concerns\ToModel;

class TelephoneDirectoryImport implements ToModel
{
    public $type;
    public function __construct(array   $type)
    {
        $this->type = $type;
    }
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        
        $isExist = TelephoneDirectory::where('name', $row[0])->first();
        if (!$isExist) {

            return new TelephoneDirectory([
                'name'     => !empty($row[0]) ? $row[0] : 'لا يوجد اسم',
                'phone_number'    => $row[1],
                'type'    => $this->type,
            ]);
        }
    }
}
