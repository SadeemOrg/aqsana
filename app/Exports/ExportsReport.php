<?php

namespace App\Exports;

use App\Models\address;
use App\Models\Project;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportsReport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    public function __construct(string $name, string $from, string $to, string $dateType, string $PaymentType)
    {
        $this->name = $name;
        $this->from = $from;
        $this->to = $to;
        $this->dateType = $dateType;
        $this->PaymentType = $PaymentType;
    }

    public function headings(): array
    {
        return ['رقم', 'المعرف', ' تاريخ السند', ' تاريخ الدفعة', 'نوع السند', 'الاسم', 'القيمة', 'طريقة الدفع'];
    }

    public function collection()
    {
        $Projects = Project::wherein('id', json_decode($this->name))->get();
        $this->from = (($this->from != 'null') ?  $this->from : '2001-01-01 00:00:00.0');
        $this->to = ($this->to != 'null') ?  $this->to :  Carbon::now();
        $startdate = date($this->from);
        $finishdate = date($this->to);

        $mergedQuery = collect();

        if ($this->dateType == 1) {
            foreach ($Projects as $key => $Project) {
                $filteredTransactionsSet1 = $Project->Transaction()->where([
                    ['main_type', '=', 1],
                    ['type', '=', 2],
                    ['is_delete', '<>', '2'],
                ])->whereBetween('transaction_date', [$startdate, $finishdate])
                    ->when($this->PaymentType != 0, function ($query) {
                        return $query->where('payment_type', $this->PaymentType);
                    })->get();
                $totalAmountMainType1 = $filteredTransactionsSet1->sum('equivelant_amount');

                $filteredTransactionsSet2 = $Project->Transaction()->where([
                    ['main_type', '=', 2],
                ])->whereBetween('transaction_date', [$startdate, $finishdate])->get();
                $totalAmountMainType2 = $filteredTransactionsSet2->sum('equivelant_amount');

                $mergedTransactions = $filteredTransactionsSet1->merge($filteredTransactionsSet2);
                $mergedTransactions->transform(function ($transaction) {
                    if ($transaction->main_type == 1) {
                        $transaction->type = 'سندات قبض';
                    } else {
                        $transaction->type = 'سندات صرف';
                    }

                    return $transaction;
                });
                $additionalRows = [

                    [' اسم المشروع ', '  ',  '  ',$Project?->project_name , ' '],
                    ['  ', '  ', '   ', ' '],
                ];
                $mergedQuery = $mergedQuery->concat([])->concat($additionalRows);

                $selectedTransactions = $mergedTransactions->map(function ($transaction, $index) use ($Project) {
                    $paymentTypeLabels = [
                        '1' => __('cash'),
                        '2' => __('shek'),
                        '3' => __('bit'),
                        '4' => __('hawale'),
                        '5' => __('حصالة'),
                        '6' => __('التطبيق'),
                    ];


                        return [
                            'bill' => $transaction->bill_number,
                            'id' => $transaction->id,
                            'date' => $transaction->transaction_date,
                            'dateDetails' => isset($transaction->Payment_type_details['0']['attributes']['Date'])
                                ? $transaction->Payment_type_details['0']['attributes']['Date']
                                : null,
                            'type' => $transaction->type,
                            'name' => $transaction->TelephoneDirectory?->name,
                            'transact_amount' => $transaction->equivelant_amount,
                            'paymentTypeValue' => $paymentTypeLabels[$transaction->Payment_type] ?? __('Unknown'),
                        ];

                });

                $additionalRows = [
                    ['  ', '  ', '   ', ' '],
                    ['  ', '  ', '   ', ' '],
                    ['المدخلات', $totalAmountMainType1, 'المخرجات', $totalAmountMainType2, 'صافي الانفاق', $totalAmountMainType1 - $totalAmountMainType2],
                    ['  ', '  ', '   ', ' '],
                    ['  ', '  ', '   ', ' '],
                ];
                $mergedQuery = $mergedQuery->concat($selectedTransactions)->concat($additionalRows);
            }

            return $mergedQuery;
        } else {
            foreach ($Projects as $key => $Project) {
                $filteredTransactionsSet1 = $Project->Transaction()
                    ->where([
                        ['main_type', '=', 1],
                        ['type', '=', 2],
                        ['is_delete', '<>', '2'],
                    ])
                    ->where(function ($query) use ($startdate, $finishdate) {
                        $query->where(function ($query) {
                            $query->where('Payment_type', '=', 1)
                                ->orWhere('Payment_type', '=', 5);
                        })->whereBetween('transaction_date', [$startdate, $finishdate])
                            ->orWhere(function ($query) use ($startdate, $finishdate) {
                                $query->whereNotIn('Payment_type', [1, 5])
                                    ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(Payment_type_details, '$[0].attributes.Date')) BETWEEN ? AND ?", [$startdate, $finishdate]);
                            });
                    })
                    ->when($this->PaymentType != 0, function ($query) {
                        return $query->where('payment_type', $this->PaymentType);
                    })
                    ->get();
                $totalAmountMainType1 = $filteredTransactionsSet1->sum('equivelant_amount');

                $filteredTransactionsSet2 = $Project->Transaction()->where([
                    ['main_type', '=', 2],
                ])->whereBetween('transaction_date', [$startdate, $finishdate])->get();
                $totalAmountMainType2 = $filteredTransactionsSet2->sum('equivelant_amount');

                $mergedTransactions = $filteredTransactionsSet1->merge($filteredTransactionsSet2);
                $mergedTransactions->transform(function ($transaction) {
                    if ($transaction->main_type == 1) {
                        $transaction->type = 'سندات قبض';
                    } else {
                        $transaction->type = 'سندات صرف';
                    }

                    return $transaction;
                });
                $additionalRows = [

                    [' اسم المشروع ', '  ',  '  ',$Project?->project_name , ' '],
                    ['  ', '  ', '   ', ' '],
                ];
                $mergedQuery = $mergedQuery->concat([])->concat($additionalRows);

                $selectedTransactions = $mergedTransactions->map(function ($transaction, $Project) {
                    $paymentTypeLabels = [
                        '1' => __('cash'),
                        '2' => __('shek'),
                        '3' => __('bit'),
                        '4' => __('hawale'),
                        '5' => __('حصالة'),
                        '6' => __('التطبيق'),
                    ];
                    return [
                        'bill' =>  $transaction->bill_number,
                        'id' =>  $transaction->id,
                        'date' =>  $transaction->transaction_date,
                        'dateDetails' => isset($transaction->Payment_type_details['0']['attributes']['Date'])
                            ? $transaction->Payment_type_details['0']['attributes']['Date']
                            : null,
                        'bill' =>  $transaction->bill_number,
                        'type' =>  $transaction->type,
                        'name' => $transaction->TelephoneDirectory?->name,
                        'transact_amount' => $transaction->equivelant_amount,
                        'paymentTypeValue' => $paymentTypeLabels[$transaction->Payment_type] ?? __('Unknown'),
                    ];
                });

                $additionalRows = [
                    ['  ', '  ', '   ', ' '],
                    ['  ', '  ', '   ', ' '],
                    ['المدخلات', $totalAmountMainType1, 'المخرجات', $totalAmountMainType2, 'صافي الانفاق', $totalAmountMainType1 - $totalAmountMainType2],
                    ['  ', '  ', '   ', ' '],
                    ['  ', '  ', '   ', ' '],
                ];
                $mergedQuery = $mergedQuery->concat($selectedTransactions)->concat($additionalRows);
            }
            return $mergedQuery;
        }
    }

    public function styles(Worksheet $sheet)
    {
        // Determine the total number of rows in the sheet
        $highestRow = $sheet->getHighestRow();


        // Apply red background to rows containing the string 'المدخلات'
        for ($row = 1; $row <= $highestRow; $row++) {
            $cellValue = $sheet->getCell("A$row")->getValue(); // Adjust column if necessary
            if ($cellValue === 'المدخلات') {
                $sheet->getStyle("A$row:I$row")->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => 'FF00FF00'], // Green color
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                ]);
            }elseif($cellValue === ' اسم المشروع ')
            {
                $sheet->getStyle("A$row:I$row")->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => '87CEEB'], // Sky blue color
                    ],
                    'font' => [
                        'bold' => true,
                    ],
                ]);
            }
        }
    }
}
