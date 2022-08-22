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
        $newsTypes = [
            [
                'name' => 'أخبار-الجمعية',
                'main_type' => '1',
                'type' => '0',
            ],
            [
                'name' => 'أخبار',
                'main_type' => '1',
                'type' => '1',
            ],
            [
                'name' => 'مقالات',
                'main_type' => '1',
                'type' => '2',
            ],
            [
                'name' => 'إحصاءات',
                'main_type' => '1',
                'type' => '3',
            ],

            [
                'name' => 'القدس-والمسجد-الأقصى',
                'main_type' => '2',
                'type' => '0',
            ],
            [
                'name' => 'أخبار',
                'main_type' => '2',
                'type' => '1',
            ],
            [
                'name' => 'مقالات',
                'main_type' => '2',
                'type' => '2',
            ],
            [
                'name' => 'إحصاءات-وتقارير',
                'main_type' => '2',
                'type' => '3',
            ],

            [
                'name' => 'الأوقاف والمقدسات',
                'main_type' => '3',
                'type' => '0',
            ],
            [
                'name' => 'أخبار-وتقارير',
                'main_type' => '3',
                'type' => '1',
            ],
            [
                'name' => 'مشروع-المسح-الشامل',
                'main_type' => '3',
                'type' => '2',
            ],

            [
                'name' => '  حصاد الجمعية',
                'main_type' => '4',
                'type' => '0',
            ],
            [
                'name' => 'حصاد',
                'main_type' => '4',
                'type' => '1',
            ],

        ];

        collect($newsTypes)->each(function ($newsTypes) {
            newsType::create([
                'name' => $newsTypes['name'],
                'main_type' => $newsTypes['main_type'],
                'type' => $newsTypes['type'],
            ]);
        });
    }
}
