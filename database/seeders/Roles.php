<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            'status' => '1',
            'code_role' => 'admin',
            'role' => 'Admin',
        ]);

        Role::create([
            'status' => '1',
            'code_role' => 'financial_user',
            'role' => 'Financial User',
        ]);

        Role::create([
            'status' => '1',
            'code_role' => 'normal_financial_user',
            'role' => 'normal financial user',
        ]);



        Role::create([
            'status' => '1',
            'code_role' => 'regular_area',
            'role' => 'Regular Area',
        ]);

        Role::create([
            'status' => '1',
            'code_role' => 'Volunteer',
            'role' => 'Volunteer',
        ]);

        Role::create([
            'status' => '1',
            'code_role' => 'regular_uses',
            'role' => 'Regular Uses',
        ]);
    }
}
