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
        return ['المشروع','رقم', 'نوع السند', 'الاسم',  'المشروع', 'القيمة'];
    }

    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $Projects = Project::wherein('id',json_decode($this->name))->get();
        $mergedQuery = collect(); // Initialize as an empty collection

       foreach ($Projects as $key => $Project) {
        $additionalRows = [

            ['', '  الاسم المشروع ',  $Project->project_name],
        ];
        $mergedQuery = $mergedQuery->concat($additionalRows);



            $filteredTransactionsSet1 = $Project->Transaction()->where([
                ['main_type', '=', 1],
                ['type', '=', 2],
                ['is_delete', '<>', '2'],
            ])->get();
            $totalAmountMainType1 = $filteredTransactionsSet1->sum('equivelant_amount');

            $filteredTransactionsSet2 = $Project->Transaction()->where([
                ['main_type', '=', 2],
            ])->get();
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

            $selectedTransactions = $mergedTransactions->map(function ($transaction,$Project) {
                return [
                    'bill' =>  $transaction->bill_number,
                    'type' =>  $transaction->type,
                    'name' => $transaction->TelephoneDirectory?->name,
                    'project_name' => $transaction->Project?->project_name,
                    'transact_amount' => $transaction->equivelant_amount,

                ];
            });


            $additionalRows = [

                ['', 'مجموع ',  $totalAmountMainType1 - $totalAmountMainType2],
            ];
            $mergedQuery = $mergedQuery->concat($selectedTransactions)->concat($additionalRows);


       }
       return $mergedQuery;


    }
}
