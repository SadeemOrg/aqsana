<?php

namespace App\Exports;

use App\Models\User;
use App\Models\WorkHours;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUsers implements FromCollection , WithHeadings
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

          array_push($array, 'day');
          array_push($array, 'date');
          array_push($array, 'start_time ');
          array_push($array, 'end_time');

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
        ->select('day', 'date', 'start_time','end_time')->orderBy('date', 'ASC')->get();
    }
}
