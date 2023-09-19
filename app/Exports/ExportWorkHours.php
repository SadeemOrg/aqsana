<?php

namespace App\Exports;

use App\Models\User;
use App\Models\WorkHours;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportWorkHours implements FromCollection , WithHeadings
{

    public function __construct(string $id ,string $startdate ,string $finishdate )
    {
        $this->id = $id;
        $this->startdate = $startdate;
        $this->finishdate = $finishdate;
    }
    public function headings(): array
    {
          $array = [];

          array_push($array, 'اليوم');
          array_push($array, 'التاريخ');
          array_push($array, 'بداء العمل');
          array_push($array, 'انتهاء العمل');
          array_push($array, 'ساعات عمل اليوم');


          return $array;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $from = date($this->startdate);
        $to = date($this->finishdate);

        return WorkHours::whereBetween('date', [$from, $to])->where('user_id', '=', $this->id)
        ->select('day', 'date', 'start_time','end_time','day_hours')->orderBy('date', 'ASC')->get();
    }
}
