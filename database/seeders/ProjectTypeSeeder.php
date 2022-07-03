<?php

namespace Database\Seeders;
use App\Models\ProjectType;
use Illuminate\Database\Seeder;

class ProjectTypeSeeder extends Seeder
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
                'name' => 'حوالات بنكيه ثابته',
                'type' => '1',
                'code' => '1',

            ],
            [
                'name' => 'تبرعات بنكيه',
                'type' => '1',
                'code' => '2',
            ],
            [
                'name' => 'حوالات ثابته فيزا',
                'type' => '1',
                'code' => '3',
            ],
            [
                'name' => 'تبرعات فيزا',
                'type' => '1',
                'code' => '4',
            ],
            [
                'name' => 'تبرعات مساجد',
                'type' => '1',
                'code' => '5',
            ],
            [
                'name' => 'حصالات',
                'type' => '1',
                'code' => '6',
            ],
            [
                'name' => 'دعم مؤسسات',
                'type' => '1',
                'code' => '7',
            ],
            [
                'name' => 'قوافل الأقصى',
                'type' => '2',
                'code' => '8',
            ],

              [
                'name' => 'مشاريع تمكينيه',
                'type' => '2',
                'code' => '9',
            ],
            [
                'name' => 'مشاريع ثقافيه تعليميه',
                'type' => '2',
                'code' => '10',
            ],
            [
                'name' => 'مشاريع انسانيه',
                'type' => '2',
                'code' => '11',
            ],
            [
                'name' => 'مصاريف إداريه ومكتبيه ومتفرقات',
                'type' => '2',
                'code' => '12',
            ],

        ];

        collect($Roles)->each(function($Roles) {
            ProjectType::create([
                'name' =>   $Roles['name'],
                'type' =>  $Roles['type'],
                'code' =>  $Roles['code'],

            ]);
        });
    }
}
