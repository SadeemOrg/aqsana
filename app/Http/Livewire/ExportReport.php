<?php

namespace App\Http\Livewire;

use App\Exports\ExportsReport;
use App\Models\Project;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class ExportReport extends Component
{
    public $key;
    public $ref;
    public $name;
    public $from;
    public $to;
    public $type;
    public $dateType;
    public $PaymentType;
    public $exportData;


    // public function mount($key, $ref)
    // {
    //     $this->key = $key;
    //     $this->ref = $ref;


    // }
    public function onChange($type) {}
    public function Report()
    {
        $projectNames = Project::whereIn('id', json_decode($this->name))
            ->pluck('project_name')
            ->implode(', ');

        $truncatedProjectNames = Str::limit($projectNames, 30, '');
        $dateToday = Carbon::now()->format('Y-m-d');

        // Construct the filename directly without encoding
        $filename = "{$truncatedProjectNames}_{$dateToday}.xlsx";

        return Excel::download(new ExportsReport($this->name, $this->from, $this->to, $this->dateType, $this->PaymentType), $filename);
    }
    public function render()
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
                ])->whereBetween('transaction_date', [$startdate, $finishdate])
                    ->when($this->PaymentType != 0, function ($query) {
                        return $query->where('payment_type', $this->PaymentType);
                    })->get();
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
                    [' اسم المشروع ', '  ',  '  ', $Project?->project_name, ''],
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
                    ['المدخلات', $totalAmountMainType1, 'المخرجات', $totalAmountMainType2, 'صافي الانفاق', $totalAmountMainType1 - $totalAmountMainType2],

                ];
                $mergedQuery = $mergedQuery->concat($selectedTransactions)->concat($additionalRows);
            }
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
                ])->whereBetween('transaction_date', [$startdate, $finishdate])
                ->when($this->PaymentType != 0, function ($query) {
                    return $query->where('payment_type', $this->PaymentType);
                })->get();
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
                    [' اسم المشروع ', '  ',  '  ', $Project?->project_name, ' '],
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
                    ['المدخلات', $totalAmountMainType1, 'المخرجات', $totalAmountMainType2, 'صافي الانفاق', $totalAmountMainType1 - $totalAmountMainType2],

                ];
                $mergedQuery = $mergedQuery->concat($selectedTransactions)->concat($additionalRows);
            }
            // return $mergedQuery;
        }

        $this->exportData = $mergedQuery;
        // dd($this->name, $this->from, $this->to,$this->dateType,$this->PaymentType);
        return view('livewire.export-report');
    }
}
