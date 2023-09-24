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
        dd();
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




    public function ExportDonations()
    {

        $key = 'Donations';
        return view('export',compact('key'));
    }
    public function ExportPaymentVoucher()
    {
        $key = 'PaymentVoucher';
        return view('export',compact('key'));
    }
    public function  ExportDelegates()
    {
        $key = 'Delegates';
        return view('export',compact('key'));
    }
    public function  ExportAlhisalat()
    {
        $key = 'Alhisalat';
        return view('export',compact('key'));

    }
    public function  ExportUsers()
    {
          $key = 'Users';
        return view('export',compact('key'));

    }
    public function  ExportAreas()
    {
        $key = 'Area';
        return view('export',compact('key'));
    }
    public function  ExportCites()
    {
        $key = 'Cites';
        return view('export',compact('key'));
    }
    public function  ExportAddress()
    {
        $key = 'Address';
        return view('export',compact('key'));
    }
    public function  ExportBusesCompany()
    {
        $key = 'BusesCompany';
        return view('export',compact('key'));
    }
}
