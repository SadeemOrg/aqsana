<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Transaction;
use App\Models\User;
use App\Models\vacation;
use App\Models\WorkHours;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use PDF;
use PharIo\Manifest\Url;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDFs($ids, $type = 1)
    {
        $idsArray = explode(',', $ids); // Split IDs by comma

        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin-top' => 0,
            'autoArabic' => true
        ]);

        foreach ($idsArray as $id) {
            $imagePaths = [
                'image1' => public_path('assets/image/iuktui.png'),
                'image2' => public_path('assets/image/-dc.png'),
                'image3' => public_path('assets/image/-removebg-preview.png'),
                'image4' => public_path('assets/image/signiture.jpg')
            ];

            foreach ($imagePaths as $key => $imagePath) {
                if (!file_exists($imagePath)) {
                    return response()->json(['error' => $key . ' file does not exist.'], 404);
                }
            }

            $Transaction = Transaction::where("id", $id)->with('Sectors')->with('Project')->with('Alhisalat')->with('TelephoneDirectory')->first();
            $TransactionArray = @json_decode(json_encode($Transaction), true);

            // Determine Payment Type based on language
            if ($Transaction->lang == 1) {
                switch ($Transaction->Payment_type) {
                    case 1:
                        $PaymentType = "نقدي";
                        break;
                    case 2:
                        $PaymentType = "شك";
                        break;
                    case 3:
                        $PaymentType = "بيت";
                        break;
                    case 4:
                        $PaymentType = "حوالة مصرفية";
                        break;
                    case 5:
                        $PaymentType = "حصالة";
                        break;
                    case 6:
                        $PaymentType = "التطبيق";
                        break;
                }
            } else if ($Transaction->lang == 2) {
                switch ($Transaction->Payment_type) {
                    case 1:
                        $PaymentType = "cash";
                        break;
                    case 2:
                        $PaymentType = "Bank doubt";
                        break;
                    case 3:
                        $PaymentType = "bit";
                        break;
                    case 4:
                        $PaymentType = "Bank transfer";
                        break;
                    case 5:
                        $PaymentType = "moneybox";
                        break;
                    case 6:
                        $PaymentType = "Application";
                        break;
                }
            } else if ($Transaction->lang == 3) {
                switch ($Transaction->Payment_type) {
                    case 1:
                        $PaymentType = "כסף מזומן";
                        break;
                    case 2:
                        $PaymentType = "ספק בבנק";
                        break;
                    case 3:
                        $PaymentType = "קצת";
                        break;
                    case 4:
                        $PaymentType = "העברה בנקאית";
                        break;
                    case 5:
                        $PaymentType = "קופסת כסף";
                        break;
                    case 6:
                        $PaymentType = "יישום";
                        break;
                }
            }

            $data = [
                'TransactionArray' => $TransactionArray,
                'PaymentType' => $PaymentType,
                'imagePaths' => $imagePaths,
                'type' => $type,

            ];

            // Render HTML for the page
            $mpdf->autoLangToFont = true;
            $mpdf->autoScriptToLang = true;
            if ($TransactionArray['lang'] == 1) {
                $html = view('pdf.ArabicPDF', $data)->render();
            } else if ($TransactionArray['lang'] == 2) {
                $html = view('pdf.myPDF', $data)->render();
            } else if ($TransactionArray['lang'] == 3) {
                $html = view('pdf.HebrowPDF', $data)->render();
            }

            $mpdf->AddPage(); // Add a new page for each ID
            $mpdf->WriteHTML($html);
        }

        $fileName = 'Multiple_PDFs.pdf';
        $mpdf->Output($fileName, 'I'); // Output the combined PDF for inline viewing

        exit; // Terminate script after generating PDF
    }

    public function generatePDF($id, $type = 1)
    {
        $imagePaths = [
            'image1' => public_path('assets/image/iuktui.png'),
            'image2' => public_path('assets/image/-dc.png'),
            'image3' => public_path('assets/image/-removebg-preview.png'),
            'image4' => public_path('assets/image/signiture.jpg')

        ];
        foreach ($imagePaths as $key => $imagePath) {
            if (!file_exists($imagePath)) {
                return response()->json(['error' => $key . ' file does not exist.'], 404);
            }
        }
        $Transaction =  Transaction::where("id", $id)->with('Sectors')->with('Project')->with('Alhisalat')->with('TelephoneDirectory')->first();
        $TransactionArray = @json_decode(json_encode($Transaction), true);

        if ($Transaction->lang == 1) {
            switch ($Transaction->Payment_type) {
                case 1:
                    $PaymentType = "نقدي";
                    break;
                case 2:
                    $PaymentType = "شك";
                    break;
                case 3:
                    $PaymentType = "بيت";
                    break;
                case 4:
                    $PaymentType = "حوالة مصرفية";
                    break;
                case 5:
                    $PaymentType = "حصالة";
                    break;
                case 6:
                    $PaymentType = "التطبيق";
                    break;
            }
        } else if ($Transaction->lang == 2) {
            switch ($Transaction->Payment_type) {
                case 1:
                    $PaymentType = "cash";
                    break;
                case 2:
                    $PaymentType = "Bank doubt";
                    break;
                case 3:
                    $PaymentType = "bit";
                    break;
                case 4:
                    $PaymentType = "Bank transfer";
                    break;
                case 5:
                    $PaymentType = "moneybox";
                    break;
                case 6:
                    $PaymentType = "Application";
                    break;
            }
        } else if ($Transaction->lang == 3) {
            switch ($Transaction->Payment_type) {
                case 1:
                    $PaymentType = "כסף מזומן";
                    break;
                case 2:
                    $PaymentType = "ספק בבנק";
                    break;
                case 3:
                    $PaymentType = "קצת";
                    break;
                case 4:
                    $PaymentType = "העברה בנקאית";
                    break;
                case 5:
                    $PaymentType = "קופסת כסף";
                    break;
                case 6:
                    $PaymentType = "יישום";
                    break;
            }
        }
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin-top' => 0,
            'autoArabic' => true
        ]);
        $type = ($Transaction->is_delete == 2) ? '2' : '1';

        $data = [
            'TransactionArray' => $TransactionArray,
            'PaymentType' =>  $PaymentType,
            'imagePaths' => $imagePaths,
            'type' => $type,
        ];
        $fileName = 'Invoices details.pdf';
        $mpdf->autoLangToFont = true;
        $mpdf->autoScriptToLang = true;
        // for Arabic Bills PDF
        if ($data['TransactionArray']['lang'] == 1) {
            $html = \view('pdf.ArabicPDF', $data);
        } else if ($data['TransactionArray']['lang'] == 2) {
            $html = \view('pdf.myPDF', $data);
        } else if ($data['TransactionArray']['lang'] == 3) {
            $html = \view('pdf.HebrowPDF', $data);
        }


        $html = $html->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output($fileName, 'I');
    }

    public function generatePDFHours(Request $request)
    {
        // Initialize error messages
        $errorUser = "";
        $errorFromDate = "";
        $errorToDate = "";

        // Validate inputs
        if (empty($request->id)) {
            $errorUser = "يجب اختيار المستخدم";
        }
        if (empty($request->FromDate)) {
            $errorFromDate = "يجب اختيار تاريخ البدء";
        }
        if (empty($request->ToDate)) {
            $errorToDate = "يجب اختيار تاريخ النهاية";
        }

        // Check if there are any validation errors
        if (!empty($errorUser) || !empty($errorFromDate) || !empty($errorToDate)) {
            return response()->json(['errorUser' => $errorUser, 'errorFromDate' => $errorFromDate, 'errorToDate' => $errorToDate]);
        }

        // Parse dates
        $from = Carbon::parse($request->FromDate);
        $to = Carbon::parse($request->ToDate);

        // Fetch work hours within the date range
        $workHours = WorkHours::where("user_id", $request->id)
            ->whereBetween('date', [$from, $to])
            ->orderBy('date', 'ASC')
            ->get();

        $sumWorkHours = $workHours->count();
        $workHours = $workHours->toArray();

        // Calculate total worked hours
        $totalTime = Carbon::parse('2001-01-01 00:00:00.0');
        foreach ($workHours as $entry) {
            if (!empty($entry['day_hours'])) {
                $time = Carbon::parse($entry['day_hours']);
                $totalTime->addHours($time->hour)->addMinutes($time->minute)->addSeconds($time->second);
            }
        }

        // Add the table name to each column in the workHours array
        $workHours = array_map(function ($item) {
            return $item + ['table' => 'work_hours'];
        }, $workHours);

        // Fetch vacations within the date range
        // $vacations = Vacation::where("user_id", $request->id)
        //     ->whereBetween('date', [$from, $to])
        //     ->orderBy('date', 'ASC')
        //     ->get();
        $vacations = Vacation::where("user_id", $request->id)
        ->where(function($query) use ($from, $to) {
            $query->whereBetween('date', [$from, $to])
                  ->orWhereBetween('end_date', [$from, $to])
                  ->orWhere(function($subQuery) use ($from, $to) {
                      $subQuery->where('date', '<', $from)
                               ->where('end_date', '>', $to);
                  });
        })
        ->orderBy('date', 'ASC')
        ->get();
        // Process vacation days, excluding weekends
        $vacations = $vacations->map(function ($vacation) use ($from, $to) {
            $vacationStart = Carbon::parse($vacation->date);
            $vacationEnd = Carbon::parse($vacation->end_date ?? $vacation->date);

            if ($vacationEnd->gt($to)) {
                $vacationEnd = $to;
            }
            if ($vacationStart->lt($from)) {
                $vacation->date = $from;

                    if ($from->isFriday() || $from->isSaturday()) {
                        $from->addDays(7 - $from->dayOfWeek);
                    }

                    $vacation->date = $from;
                    $vacation->day = $from->locale('ar')->isoFormat('dddd');
            }

            $currentDate = $vacationStart->copy();
            $currentDate = Carbon::parse($vacation->date);

            $actualDays = 0;
            while ($currentDate->lte($vacationEnd)) {
                if (!$currentDate->isFriday() && !$currentDate->isSaturday()) {
                    $actualDays++;
                }
                $currentDate->addDay();
            }
            $vacation->days = $actualDays;
            return $vacation;
        });
        $sumVacation = $vacations->sum('days');
        $vacations = $vacations->toArray();

        // Add the table name to each column in the vacations array
        $vacations = array_map(function ($item) use ($to) {
            // Parse the start and end dates for comparison
            $item['date'] = Carbon::parse($item['date']);
            $item['end_date'] = $item['end_date'] ? Carbon::parse($item['end_date']) : $item['date'];

            // If end_date is greater than $to, set end_date to $to
            if ($item['end_date']->gt($to)) {
                $item['end_date'] = $to;
            }

            return $item + ['table' => 'vacations'];
        }, $vacations);


        // Merge and sort records by date
        $mergedArray = array_merge($workHours, $vacations);
        $mergedCollection = new Collection($mergedArray);
        $sortedCollection = $mergedCollection->sortBy('date');
        $sortedArray = $sortedCollection->values()->toArray();

        // Generate PDF
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin-top' => 0,
            'autoArabic' => true
        ]);
        $data = [
            'data' => $sortedArray,
            'user' => User::find($request->id)->name,
            'sumVacation' => $sumVacation,
            'sumWorkHours' => $sumWorkHours,
            'totalTime' => $totalTime,
        ];
        $fileName = 'Invoices_details.pdf';

        // Render and output PDF
        $html = view('pdf.WorkHours', $data)->render();
        $mpdf->autoLangToFont = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->WriteHTML($html);
        $mpdf->Output($fileName, 'I');
    }

    public function generatePDFReport(Request $request)
    {
        $Projects = Project::wherein('id', json_decode($request->name))->get();
        $request->from = (($request->from != 'null') ?  $request->from : '2001-01-01 00:00:00.0');
        $request->to = ($request->to != 'null') ?  $request->to :  Carbon::now();
        $startdate = date($request->from);
        $finishdate = date($request->to);


        $mergedQuery = collect();

        if ($request->dateType == 1) {

            foreach ($Projects as $key => $Project) {
                $filteredTransactionsSet1 = $Project->Transaction()->where([
                    ['main_type', '=', 1],
                    ['type', '=', 2],
                    ['is_delete', '<>', '2'],
                ])->whereBetween('transaction_date', [$startdate, $finishdate])
                    ->when($request->PaymentType != 0, function ($query) use ($request) {
                        return $query->where('payment_type', $request->PaymentType);
                    })->get();
                $totalAmountMainType1 = $filteredTransactionsSet1->sum('equivelant_amount');
                $filteredTransactionsSet2 = $Project->Transaction()->where([
                    ['main_type', '=', 2],
                ])->whereBetween('transaction_date', [$startdate, $finishdate])->when($request->PaymentType != 0, function ($query) use ($request) {
                    return $query->where('payment_type', $request->PaymentType);
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
                    ->when($request->PaymentType != 0, function ($query) use ($request) {
                        return $query->where('payment_type', $request->PaymentType);
                    })
                    ->get();
                $totalAmountMainType1 = $filteredTransactionsSet1->sum('equivelant_amount');

                $filteredTransactionsSet2 = $Project->Transaction()->where([
                    ['main_type', '=', 2],
                ])->whereBetween('transaction_date', [$startdate, $finishdate])
                    ->when($request->PaymentType != 0, function ($query) use ($request) {
                        return $query->where('payment_type', $request->PaymentType);
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
            }
        }
        $data = [
            'data' => $selectedTransactions,
            '$dateType' => $request->dateType,
            // 'sumVacation' => $sumVacation,
            // 'sumWorkHours' => $sumWorkHours,
            // 'totalTime' => $date,

        ];
        //    dd( $selectedTransactions);
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin-top' => 0,
            'autoArabic' => true
        ]);

        $fileName = 'Invoices details.pdf';
        $mpdf->autoLangToFont = true;
        $mpdf->autoScriptToLang = true;
        // for Arabic Bills PDF

        $html = \view('pdf.exportReport', $data);


        $html = $html->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output($fileName, 'I');
    }
}
