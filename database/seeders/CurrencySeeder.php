<?php

namespace Database\Seeders;
use App\Models\Currency;

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Currencys = [
            [
                'name' => 'USD',
                'code' => 'USD',
                'rate' => '3.44',
            ],
            [
                'name' => 'EUR',
                'code' => 'EUR',
                'rate' => '3.53',
            ],
            [
                'name' => 'ILS',
                'code' => 'ILS',
                'rate' => '1',
            ],

        ];

        collect($Currencys)->each(function($Currencys) {
            Currency::create([
                'name' => $Currencys['name'],
                'code' => $Currencys['code'],
                'rate' => $Currencys['rate'],

            ]);
        });

    }
}
