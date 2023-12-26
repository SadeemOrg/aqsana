<?php

namespace App\Http\Controllers;

use App\Exports\ExportAddress;
use App\Exports\ExportAlhisalat;
use App\Exports\ExportAreas;
use App\Exports\ExportBusesCompany;
use App\Exports\ExportCites;
use App\Exports\ExportDelegates;
use App\Exports\ExportDonations;
use App\Exports\ExportPaymentVoucher;
use Illuminate\Http\Request;
use App\Exports\ExportUsers;
use App\Exports\ExportWorkHours;
use App\Models\Sector;
use Maatwebsite\Excel\Facades\Excel;


class ExportExcelController extends Controller
{


    public function index()
    {
        dd("ww");
        $key = 'Donationsw';
       return view('export',compact('key'));
    }

    public function submit(Request $request)
    {
          return Excel::download(new ExportDonations, 'dd.csv');

        dd("dd");
       return view('test');
    }


    public function exportExcelFile(Request $request)
    {

        return Excel::download(new ExportWorkHours(1,11,1), 'users.csv');
    }
    public function ExportWorkHours(Request $request)
    {

        return Excel::download(new ExportWorkHours(1,11,1), 'users.csv');
    }

    //




    public function ExportDonations(Request $request)
    {

        $ref= ($request->ref != null) ? $request->ref : 'null';
        $name= ($request->name != null) ? $request->name : 'null';
        $from= ($request->from != null) ? $request->from : 'null';
        $to= ($request->to != null) ? $request->to : 'null';

        $key = 'Donations';
        return view('export',compact('key','ref','name','from','to'));
    }

    public function ExportReport(Request $request)
    {
        dd("dd");

        $ref= ($request->ref != null) ? $request->ref : 'null';
        $name= ($request->name != null) ? $request->name : 'null';
        $from= ($request->from != null) ? $request->from : 'null';
        $to= ($request->to != null) ? $request->to : 'null';


        $key = 'Report';
        return view('export',compact('key','ref','name','from','to'));
    }
    public function ExportPaymentVoucher(Request $request)
    {

        $ref= ($request->ref != null) ? $request->ref : 'null';
        $name= ($request->name != null) ? $request->name : 'null';
        $from= ($request->from != null) ? $request->from : 'null';
        $to= ($request->to != null) ? $request->to : 'null';
        $key = 'PaymentVoucher';

        return view('export',compact('key','ref','name','from','to'));
    }
    public function  ExportDelegates(Request $request)
    {
        $ref= ($request->ref != null) ? $request->ref : 'null';
        $name= ($request->name != null) ? $request->name : 'null';
        $from= ($request->from != null) ? $request->from : 'null';
        $to= ($request->to != null) ? $request->to : 'null';

        $key = 'Delegates';
        return view('export',compact('key','ref','name','from','to'));
    }
    public function  ExportAlhisalat(Request $request)
    {
        $ref= ($request->ref != null) ? $request->ref : 'null';
        $name= ($request->name != null) ? $request->name : 'null';
        $from= ($request->from != null) ? $request->from : 'null';
        $to= ($request->to != null) ? $request->to : 'null';
        $key = 'Alhisalat';
        return view('export',compact('key','ref','name','from','to'));

    }
    public function  ExportUsers(Request $request)
    {
        $ref= ($request->ref != null) ? $request->ref : 'null';
        $name= ($request->name != null) ? $request->name : 'null';
        $from= ($request->from != null) ? $request->from : 'null';
        $to= ($request->to != null) ? $request->to : 'null';
          $key = 'Users';
          return view('export',compact('key','ref','name','from','to'));

    }
    public function  ExportAreas(Request $request)
    {
        $ref= ($request->ref != null) ? $request->ref : 'null';
        $name= ($request->name != null) ? $request->name : 'null';
        $from= ($request->from != null) ? $request->from : 'null';
        $to= ($request->to != null) ? $request->to : 'null';
        $key = 'Area';
        return view('export',compact('key','ref','name','from','to'));
    }
    public function  ExportCites(Request $request)
    {
        $ref= ($request->ref != null) ? $request->ref : 'null';
        $name= ($request->name != null) ? $request->name : 'null';
        $from= ($request->from != null) ? $request->from : 'null';
        $to= ($request->to != null) ? $request->to : 'null';
        $key = 'Cites';
        return view('export',compact('key','ref','name','from','to'));
    }
    public function  ExportAddress(Request $request)
    {
        $ref= ($request->ref != null) ? $request->ref : 'null';
        $name= ($request->name != null) ? $request->name : 'null';
        $from= ($request->from != null) ? $request->from : 'null';
        $to= ($request->to != null) ? $request->to : 'null';
        $key = 'Address';
        return view('export',compact('key','ref','name','from','to'));
    }
    public function  ExportBusesCompany(Request $request)
    {
        $ref= ($request->ref != null) ? $request->ref : 'null';
        $name= ($request->name != null) ? $request->name : 'null';
        $from= ($request->from != null) ? $request->from : 'null';
        $to= ($request->to != null) ? $request->to : 'null';
        $key = 'BusesCompany';
        return view('export',compact('key','ref','name','from','to'));
    }
}
