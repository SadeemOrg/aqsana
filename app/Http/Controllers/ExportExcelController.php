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
use Maatwebsite\Excel\Facades\Excel;


class ExportExcelController extends Controller
{
     public function index()
    {
       return view('test');
    }

    public function exportExcelFile(Request $request)
    {
        // dd($request->all());
        return Excel::download(new ExportWorkHours(1,11,1), 'users.csv');
    }
    public function ExportWorkHours(Request $request)
    {

        return Excel::download(new ExportWorkHours(1,11,1), 'users.csv');
    }
    public function ExportDonations()
    {

        return Excel::download(new ExportDonations, 'dd.xlsx');
    }
    public function ExportPaymentVoucher()
    {
        return Excel::download(new ExportPaymentVoucher, 'rr.csv');
    }
    public function  ExportDelegates()
    {
        return Excel::download(new  ExportDelegates, 'rr.csv');
    }
    public function  ExportAlhisalat()
    {
        return Excel::download(new  ExportAlhisalat, 'rr.csv');
    }
    public function  ExportUsers()
    {
        return Excel::download(new  ExportUsers, 'rr.csv');
    }
    public function  ExportAreas()
    {
        return Excel::download(new  ExportAreas, 'rr.csv');
    }
    public function  ExportCites()
    {
        return Excel::download(new  ExportCites, 'rr.csv');
    }
    public function  ExportAddress()
    {
        return Excel::download(new  ExportAddress, 'rr.csv');
    }
    public function  ExportBusesCompany()
    {
        return Excel::download(new  ExportBusesCompany, 'rr.csv');
    }
}
