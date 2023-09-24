<?php

namespace App\Exports;

use App\Models\Project;
use App\Models\Sector;
use App\Models\TelephoneDirectory;
use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class   ExportDonations implements FromCollection, WithHeadings
{

    public function headings(): array
    {
        return ['id','sector',  'equivelant_amount', 'name', 'company_number', 'bill_number', 'payment_reason', 'transaction_date'];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $Transactions = Transaction::where([
            ['main_type', 1],
            ['type', 2]
        ])->select('id','sector', 'equivelant_amount', 'name', 'company_number', 'bill_number', 'payment_reason', 'transaction_date')->get();
        foreach ($Transactions as $key => $Transaction) {
            // dd(Sector::find($Transaction-> ref_id)->select('text')->first()->text);
            // $id=$Transaction-> ref_id;
            if ($Transaction->sector != null) {
                $sector = Sector::find($Transaction->sector)->first()->text;
                $Transaction->sector = $sector;
            }

            if ($Transaction->name != null) {

                $name = TelephoneDirectory::find($Transaction->name)->name;
                // dd($Transaction->name,$name,TelephoneDirectory::find($Transaction->name)->name);
                $Transaction->name = $name;

            }


        }

        return $Transactions;
    }
}
