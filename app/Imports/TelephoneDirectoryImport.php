<?php

namespace App\Imports;

use App\Models\TelephoneDirectory;
use Maatwebsite\Excel\Concerns\ToModel;
use  App\Models\City;

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
           
            $phone = $row[1];

                $prefixes = ['+972', '+970', '0972', '0970'];
                foreach ($prefixes as $prefix) {
                    if (strpos($phone, $prefix) === 0) {
                        $phone = substr($phone, strlen($prefix));
                        break; // stop after first match
                    }
                }

                // Remove dashes
                $phone = str_replace('-', '', $phone);

                // Ensure it starts with 0
                if (substr($phone, 0, 1) !== '0') {
                    $phone = '0' . $phone;
                }
                $cityRecord = City::where('name', trim($row[2]))->first();

                if ($cityRecord) {
                    $city = $cityRecord->id;
                } else {
                    $city = null; 
                }

            return new TelephoneDirectory([
                'name'     => !empty($row[0]) ? $row[0] : 'لا يوجد اسم',
                'phone_number' => $phone,
                'city' => $city ? $city : '',
                'type'    => $this->type,
            ]);
        }
    }
}
