<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use App\Models\vacation;
use App\Models\WorkHours;
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
    public function generatePDF($id)
    {
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
            }
        }
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin-top' => 0,
            'autoArabic' => true
        ]);

        $data = [
            'TransactionArray' => $TransactionArray,
            'PaymentType' =>  $PaymentType
        ];
        $fileName = 'Invoices details.pdf';
        $mpdf->autoLangToFont = true;
        $mpdf->autoScriptToLang = true;
        // for Arabic Bills PDF
        if ($data['TransactionArray']['lang'] == 1) {
            $html = \view('pdf.ArabicPDF', $data);
            // for English Bills PDF
        } else if ($data['TransactionArray']['lang'] == 2) {
            $html = \view('pdf.myPDF', $data);
        }
        else if($data['TransactionArray']['lang'] == 3){
            $html = \view('pdf.HebrowPDF', $data);

        }


        $html = $html->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output($fileName, 'I');
    }

    public function generatePDFHours(Request $request )
    {

        $from = date($request->FromDate);
        $to = date($request->ToDate);

        $tableNameWorkHours = 'work_hours'; // replace with your actual table name
        $tableNameVacations = 'vacations'; // replace with your actual table name


        $workHours = WorkHours::where("user_id", $request->id)
            ->orderBy('date', 'ASC')
            ->get();
            $sumWorkHours = $workHours->count();
            $workHours = $workHours->toArray();

               // Add the table name to each column in the workHours array
               $workHours = array_map(function ($item) use ($tableNameWorkHours) {
                return array_combine(
                    array_map(function ($key) use ($tableNameWorkHours) {
                        return  $key;
                    }, array_keys($item)),
                    $item
                ) + ['table' => $tableNameWorkHours];
            }, $workHours);


            $vacations = vacation::where("user_id", $request->id)
                ->orderBy('date', 'ASC')
                ->get();


            $sumVacation = $vacations->count();
            $vacations = $vacations->toArray();

               // Add the table name to each column in the vacations array
               $vacations = array_map(function ($item) use ($tableNameVacations) {
                return array_combine(
                    array_map(function ($key) use ($tableNameVacations) {
                        return  $key;
                    }, array_keys($item)),
                    $item
                ) + ['table' => $tableNameVacations];
            }, $vacations);

            $mergedArray = array_merge($workHours, $vacations);

            // Create a new collection from the merged array
            $mergedCollection = new Collection($mergedArray);

            // Sort the merged collection by the 'date' field
            $sortedCollection = $mergedCollection->sortBy('date');

            // Convert the sorted collection to an array
            $sortedArray = $sortedCollection->values()->toArray();

        // $Transaction =  Transaction::where("id", $id)->with('Sectors')->with('Project')->with('Alhisalat')->with('TelephoneDirectory')->first();
        // $TransactionArray = @json_decode(json_encode($Transaction), true);


        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin-top' => 0,
            'autoArabic' => true
        ]);

        $data = [
            'data' => $sortedArray,
            'user' =>User::find( $request->id)->name,
            'sumVacation'=>$sumVacation,
            'workHours'=>$workHours,

        ];
        // dd( $data );
        $fileName = 'Invoices details.pdf';
        $mpdf->autoLangToFont = true;
        $mpdf->autoScriptToLang = true;
        // for Arabic Bills PDF
        $html = \view('pdf.WorkHours', $data);


        $html = $html->render();
        $mpdf->WriteHTML($html);
        $mpdf->Output($fileName, 'I');
    }
}
