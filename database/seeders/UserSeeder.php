<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'alaqsaAdmin',
                'email' => 'alaqsaAdmine@averotech.com',
                'user_role' => 'admin',
            ],
               [
                'name' => 'Almuahadaadmin',
                'email' => 'Almuahadaadmin@averotech.com',
                'user_role' => 'Almuahada_admin',
            ],
            [
                'name' => 'alaqsaFinancialUser',
                'email' => 'alaqsaFinancialUser@averotech.com',
                'user_role' => 'financial_user',
            ],
            [
                'name' => 'alaqsaNormalFinancialUser',
                'email' => 'alaqsaNormalFinancialUser@averotech.com',
                'user_role' => 'normal_financial_user',
            ],
            [
                'name' => 'alaqsaRegularArea',
                'email' => 'alaqsaRegularArea@averotech.com',
                'user_role' => 'regular_area',
            ],
            [
                'name' => 'alaqsaRegularCity',
                'email' => 'alaqsaRegularCity@averotech.com',
                'user_role' => 'regular_city',
            ],
            [
                'name' => 'alaqsaVolunteer',
                'email' => 'alaqsaVolunteer@averotech.com',
                'user_role' => 'Volunteer',
            ],
            [
                'name' => 'alaqsaRegularUses',
                'email' => 'alaqsaRegularUses@averotech.com',
                'user_role' => 'regular_uses',
            ],
            [
                'name' => 'alaqsaWebsiteAdmin',
                'email' => 'alaqsaWebsiteAdmin@averotech.com',
                'user_role' => 'website_admin',
            ],



        ];


            collect($users)->each(function($users) {
                User::create([
                    'name' =>$users['name'],
                    'email' => $users['email'],
                    'password' => bcrypt('10203040'),
                    'remember_token' => Str::random(10),
                    'user_role'=>$users['user_role'],
                    'phone'=>'0569465465',
                    'city_id'=>'1']);
            });




    }
}
