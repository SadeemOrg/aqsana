<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Spatie\DbDumper\Databases\MySql;

class ExportController extends Controller
{

    // public function export()
    // {
    //     // Get database credentials from environment variables
    //     $mysqlHostName = env('DB_HOST');
    //     $mysqlUserName = env('DB_USERNAME');
    //     $mysqlPassword = env('DB_PASSWORD');
    //     $dbName = env('DB_DATABASE');

    //     // Connect to the database
    //     $dsn = "mysql:host=$mysqlHostName;dbname=$dbName;charset=utf8";
    //     $pdo = new \PDO($dsn, $mysqlUserName, $mysqlPassword, [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);

    //     // Get all table names
    //     $tables = $pdo->query('SHOW TABLES')->fetchAll(\PDO::FETCH_COLUMN);

    //     // Start output buffer
    //     ob_start();

    //     // Output SQL dump
    //     foreach ($tables as $table) {
    //         // Data insertion statements
    //         $stmt = $pdo->query("SELECT * FROM $table");
    //         while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
    //             echo "INSERT INTO $table (";
    //             echo implode(", ", array_keys($row)) . ") VALUES (";
    //             echo implode(", ", array_map(function ($value) use ($pdo) {
    //                 return $pdo->quote($value);
    //             }, $row));
    //             echo ");\n";
    //         }
    //     }

    //     // Finish output buffering and get contents
    //     $output = ob_get_clean();

    //     // Generate file name
    //     $fileName = 'database_backup_' . date('Y-m-d_H-i-s') . '.sql';

    //     // Set headers for file download
    //     header('Content-Type: application/octet-stream');
    //     header('Content-Disposition: attachment; filename="' . $fileName . '"');
    //     header('Expires: 0');
    //     header('Cache-Control: must-revalidate');
    //     header('Pragma: public');
    //     header('Content-Length: ' . strlen($output));

    //     // Output file content
    //     echo $output;

    //     // Exit script
    //     exit;
    // }

    public function export()
    {
        $mysqlHostName = env('DB_HOST');
        $mysqlUserName = env('DB_USERNAME');
        $mysqlPassword = env('DB_PASSWORD');
        $dbName = env('DB_DATABASE');
        $dsn = "mysql:host=$mysqlHostName;dbname=$dbName;charset=utf8";
        $pdo = new \PDO($dsn, $mysqlUserName, $mysqlPassword, [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]);
        $tables = $pdo->query('SHOW TABLES')->fetchAll(\PDO::FETCH_COLUMN);
        ob_start();
        foreach ($tables as $table) {
            $stmt = $pdo->query("SELECT * FROM $table");
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                echo "INSERT INTO `$table` (";
                echo implode(", ", array_map(function ($column) {
                    return "`$column`";
                }, array_keys($row))) . ") VALUES (";
                echo implode(", ", array_map(function ($value) use ($pdo) {
                    return $pdo->quote($value);
                }, $row));
                echo ");\n";
            }
        }
        $output = ob_get_clean();
        $fileName = 'database_backup_' . date('Y-m-d_H-i-s') . '.sql';
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . strlen($output));
        echo $output;
        exit;
    }



    public function deleteAllData()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        $tables = DB::select('SHOW TABLES');

        foreach ($tables as $table) {
            $table = reset($table);
            if ($table != 'migrations') {
                DB::table($table)->truncate();
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        return redirect()->route('home')->with('success', 'All data deleted successfully.');
    }
}
