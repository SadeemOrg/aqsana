<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Notifications = [
            [
                'id'=>'1',
                'title' => 'تم انشاء مشروع',
                'message' => 'تم انشاء مشروع',
            ],
            [
                'id'=>'2',
                'title' => 'تم انشاء قافلة',
                'message' => 'تم انشاء قافلة',
            ],
            [
                'id'=>'3',
                'title' => 'تم انشاء رحلة',
                'message' =>'تم انشاء رحلة',
            ],
            [
                'id'=>'4',
                'title' => 'تم انشاء حصالة',
                'message' => 'تم انشاء حصالة',
            ],
            [
                'id'=>'5',
                'title' => 'تم جمع حصالة',
                'message' => 'تم جمع حصالة',
            ],


        ];

        collect($Notifications)->each(function($Notifications) {
            Notification::create([
                'id'=>$Notifications['id'],
                'title' => $Notifications['title'],
                'message' => $Notifications['message'],

            ]);
        });

    }
}
