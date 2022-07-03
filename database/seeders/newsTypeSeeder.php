<?php

namespace Database\Seeders;
use App\Models\newsType;
use Illuminate\Database\Seeder;

class newsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Roles = [
            [
                'code_role' => 'admin',
                'role' => 'Admin',
            ],
            [
                'code_role' => 'financial_user',
                'role' => 'Financial User',
            ],
            [
                'code_role' => 'normal_financial_user',
                'role' => 'normal financial user',
            ],
            [
                'code_role' => 'regular_area',
                'role' => 'Regular Area',
            ],
            [
                'code_role' => 'Volunteer',
                'role' => 'Volunteer',
            ],
            [
                'code_role' => 'regular_uses',
                'role' => 'Regular Uses',
            ],
            [
                'code_role' => 'website_admin',
                'role' => 'Website Admin',
            ]


        ];

        collect($Roles)->each(function($Roles) {
            newsType::create([
                'status' => '1',
                'code_role' => 'admin',
                'role' => 'Admin',
            ]);
        });
    }
}
