<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
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
        $fileName = 'Invoices details';
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
}
