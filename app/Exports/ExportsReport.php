<?php

namespace App\Exports;

use App\Models\address;
use App\Models\Project;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportsReport implements FromCollection , WithHeadings
{


    public function __construct(array $name)
    {

        $this->name = $name;

    }

    public function headings(): array
    {
        return ['رقم', 'الاسم',  'تاريخ البدء', 'تاريخ الانتهاء', 'مدخولات', 'مخروجات', 'صافي'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {


        $Projects = Project::whereIn('id', $this->name)
        ->select('id', 'project_name', 'start_date', 'end_date', 'in_come', 'out_come', 'Net_in_come')
        ->get();



        return $Projects;
    }
}
