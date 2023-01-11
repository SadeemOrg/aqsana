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
        // $Transaction =  Transaction::where("id", $id)->with('Sectors')->with('Project')->with('TelephoneDirectory')->first();
        // $data = [
        //     'title' => $id,
        //     'date' =>  $Transaction->id
        // ];

        // $pdf = PDF::loadView('myPDF', $data);

        // return $pdf->download('codesolutionstuff.pdf');
    }
}
