<?php

namespace App\Exports;

use App\Models\address;
use App\Models\Project;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportsReport implements FromCollection , WithHeadings
{


    public function __construct(string $from, string $to)
    {

        $this->from = $from;
        $this->to = $to;
    }

    public function headings(): array
    {
        return ['id', 'الاسم',  'تاريخ البدء', 'تاريخ الانتهاء', 'مدخولات', 'مخروجات', 'صافي'];
    }

    /**
    * @return \Illuminate\Support\Collection
    */

    public function collection()
    {
        $from = (( $this->from !='null') ?  $this->from : '2001-01-01 00:00:00.0' );
        $this->to=( $this->to !='null') ?  $this->to :  Carbon::now();
        $startdate = date($this->from);
        $finishdate = date($this->to);
        $Projects = Project::whereBetween('start_date', [$startdate, $finishdate])
        ->whereBetween('end_date', [$startdate, $finishdate])
        ->select('id', 'project_name', 'start_date', 'end_date', 'in_come', 'out_come', 'Net_in_come')
        ->get();



        return $Projects;
    }
}
