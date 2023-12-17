<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ExportController extends Controller
{
    public function export()
    {
        $data = DB::table('transactions')->get();

        $csvFileName = 'export_' . Str::random(10) . '.csv';
        $csvFilePath = storage_path("app/public/{$csvFileName}");

        $csvFile = fopen($csvFilePath, 'w');

        // Add CSV headers
        fputcsv($csvFile, array_keys((array) $data->first()));

        // Add data rows
        foreach ($data as $row) {
            fputcsv($csvFile, (array) $row);
        }

        fclose($csvFile);

        return response()->download($csvFilePath)->deleteFileAfterSend();
    }
    public function deleteAllData()
    {
        // Disable foreign key checks to prevent issues with deleting data
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // List all tables in the database and delete all data from each one
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $table = reset($table);
            dd($table);
            // Skip migrations table to avoid issues
            if ($table != 'migrations') {
                DB::table($table)->truncate();
            }
        }

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return redirect()->route('home')->with('success', 'All data deleted successfully.');
    }
}
