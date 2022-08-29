<?php

namespace Database\Seeders;

use App\Models\address;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */



    public function run()
    {
        $Address = [
            [
                'name_address' => 'Jerusalem',
                'description' => 'Jerusalem',
                'phone_number_address' => '00',
                'current_location' => '{"country":"Israel","countryCode":"il","latlng":{"lat":31.769,"lng":35.2163},"name":"Jerusalem","query":"ontefiore Windmill Sderot Blumfield Jerusalem","type":"city","value":"Jerusalem, Israel"}',
                'status' => '1',
            ],
        ];
            collect($Address)->each(function($Address) {
                address::create([
                    'id' => '1',
                    'name_address' => $Address['name_address'],
                    'description' => $Address['description'],
                    'phone_number_address' => $Address['phone_number_address'],
                    'current_location' => $Address['current_location'],
                    'status' => $Address['status'],

                ]);
            });

    }
}
