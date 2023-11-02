<?php

namespace App\Exports;

use App\Models\WorkHours;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportAdminWorkHours implements FromCollection, WithHeadings
{

    public function __construct(string $id, string $startdate, string $finishdate)
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
        $string = '2001-01-01 00:00:00.0';
        $date = Carbon::parse($string);
        $WorkHours = WorkHours::whereBetween('date', [$from, $to])->where('user_id', '=', $this->id)
            ->select('day', 'date', 'start_time', 'end_time', 'day_hours')->orderBy('date', 'ASC')->get();
        foreach ($WorkHours as $key => $value) {
            if ($value->day_hours != null) {
                $time2 = Carbon::parse($value->day_hours);
                $hours = $time2->hour;
                $minutes = $time2->minute;
                $seconds = $time2->second;

                $date->addSeconds($seconds)->addMinutes($minutes)->addHours($hours);
            }
        }
        $date = Carbon::parse($date);
        $sumWorkHourssearch = $date;
        $endHour =  ($sumWorkHourssearch->day - 1) * 24 + $sumWorkHourssearch->hour . ':' . $sumWorkHourssearch->minute . ':' . $sumWorkHourssearch->second;

        $additionalRows = [
            ['Column1', 'Column2', 'Column3'],
            ['', 'مجموع الساعات',  $endHour],
            // Add more rows as needed
        ];
        $mergedQuery = $WorkHours->union($additionalRows);

// dd($additionalRows,$mergedQuery);
        return $mergedQuery;
    }
}
