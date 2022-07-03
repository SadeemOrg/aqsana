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
        User::create([
            'name' => 'alaqsaAdmin',
            'email' => 'alaqsa@averotech.com',
            'password' => bcrypt('10203040'),
            'remember_token' => Str::random(10),
            'user_role'=>'admin',
            'phone'=>'0569465465',
            'city_id'=>'1']);



    }
}
