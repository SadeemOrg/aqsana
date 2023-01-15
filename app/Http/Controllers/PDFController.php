<?php
 namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
 use PDF;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id)
    {
        $Transaction =  Transaction::where("id", $id)->with('Sectors')->with('Project')->with('TelephoneDirectory')->first();
        $TransactionArray= @json_decode(json_encode($Transaction), true);
        dd($TransactionArray);
        $pdf = PDF::loadView('myPDF', $TransactionArray);
        return $pdf->download('codesolutionstuff.pdf');
    }
}
