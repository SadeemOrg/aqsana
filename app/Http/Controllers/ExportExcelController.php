<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportUsers;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
     public function index()
    {
       return view('test');
    }

    public function exportExcelFile(Request $request)
    {
        dd($request->all());
        return Excel::download(new ExportUsers(1,11,1), 'users.csv');
    }
}
