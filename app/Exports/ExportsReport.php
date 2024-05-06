<?php

namespace App\Exports;

use App\Models\address;
use App\Models\Project;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportsReport implements FromCollection, WithHeadings
{


    public function __construct(string $name, string $from, string $to)
    {
        $this->name = $name;
        $this->from = $from;
        $this->to = $to;
    }

    public function headings(): array
    {
        return ['رقم', 'نوع السند', 'الاسم',  'المشروع', 'القيمة'];
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $Projects = Project::find($this->name);
        // dd($this->from !='null');
        $from = (($this->from != 'null') ?  $this->from : '2001-01-01 00:00:00.0');
        $this->to = ($this->to != 'null') ?  $this->to :  Carbon::now();
        $startdate = date($this->from);
        $finishdate = date($this->to);
        if ($Projects) {
            $filteredTransactionsSet1 = $Projects->Transaction()->where([
                ['main_type', '=', 1],
                ['type', '=', 2],
                ['is_delete', '<>', '2'],
            ])->whereBetween('transaction_date', [$startdate, $finishdate])->get();
            $totalAmountMainType1 = $filteredTransactionsSet1->sum('equivelant_amount');

            $filteredTransactionsSet2 = $Projects->Transaction()->where([
                ['main_type', '=', 2],
            ])->whereBetween('transaction_date', [$startdate, $finishdate])->get();
            $totalAmountMainType2 = $filteredTransactionsSet2->sum('equivelant_amount');

            $mergedTransactions = $filteredTransactionsSet1->merge($filteredTransactionsSet2);
            $mergedTransactions->transform(function ($transaction) {
                // Check if main_type is 1
                if ($transaction->main_type == 1) {
                    $transaction->type = 'سندات قبض';
                } else {
                    $transaction->type = 'سندات صرف';
                }

                return $transaction;
            });

            $selectedTransactions = $mergedTransactions->map(function ($transaction) {
                return [
                    'id' => $transaction->id,
                    'type' =>  $transaction->type,
                    'name' => $transaction->TelephoneDirectory?->name,
                    'project_name' => $transaction->Project?->project_name, // Access project name via the relationship
                    'transact_amount' => $transaction->equivelant_amount,

                ];
            });


            $additionalRows = [

                ['', 'مجموع ',  $totalAmountMainType1 - $totalAmountMainType2],
            ];
            $mergedQuery = $selectedTransactions->concat($additionalRows);

            return $mergedQuery;
        } else {
            // Handle case where project with given ID doesn't exist
        }
    }
}
