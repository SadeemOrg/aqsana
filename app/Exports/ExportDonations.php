<?php

namespace App\Exports;

use App\Models\Project;
use App\Models\Sector;
use App\Models\TelephoneDirectory;
use App\Models\Transaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class   ExportDonations implements FromCollection, WithHeadings
{
    public function __construct(string $id, string $name, string $from, string $to)
    {
        $this->id = $id;
        $this->name = $name;
        $this->from = $from;
        $this->to = $to;
    }
    public function headings(): array
    {
        return ['id', 'قطاع',  'قيمة التبرغ', 'اسم', 'رقم الشركة', 'رقم الفاتوره', 'سبب التبرع', 'تاريخ الصفقة', 'مشروع'];
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // dd($this->from !='null');
        $from = (( $this->from !='null') ?  $this->from : '2001-01-01 00:00:00.0' );
        $this->to=( $this->to !='null') ?  $this->to :  Carbon::now();
        $startdate = date($this->from);
        $finishdate = date($this->to);
        if ($this->id != 'null' && $this->name == 'null') {

            $Transactions = Transaction::where([
                ['main_type', 1],
                ['type', 2],
                ['ref_id', $this->id]

            ])->whereBetween('transaction_date', [$startdate, $finishdate])->select('id', 'sector', 'equivelant_amount', 'name', 'company_number', 'bill_number', 'payment_reason', 'transaction_date', 'ref_id')->get();
        } elseif ($this->name != 'null' && $this->id == 'null') {

            $Transactions = Transaction::where([
                ['main_type', 1],
                ['type', 2],
                ['name', $this->name]
            ])->whereBetween('transaction_date', [$startdate, $finishdate])->select('id', 'sector', 'equivelant_amount', 'name', 'company_number', 'bill_number', 'payment_reason', 'transaction_date', 'ref_id')->get();
        } elseif ($this->name != 'null' && $this->id != 'null') {

            $Transactions = Transaction::where([
                ['main_type', 1],
                ['type', 2],
                ['name', $this->name],
                ['ref_id', $this->id]
            ])->whereBetween('transaction_date', [$startdate, $finishdate])->select('id', 'sector', 'equivelant_amount', 'name', 'company_number', 'bill_number', 'payment_reason', 'transaction_date', 'ref_id')->get();
        } else {
            $Transactions = Transaction::where([
                ['main_type', 1],
                ['type', 2]
            ])->whereBetween('transaction_date', [$startdate, $finishdate])->select('id', 'sector', 'equivelant_amount', 'name', 'company_number', 'bill_number', 'payment_reason', 'transaction_date')->get();
        }
        // dd( $Transactions);

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
            if ($Transaction->ref_id != null) {

                $ref = Project::find($Transaction->ref_id)->project_name;
                // dd($Transaction->name,$name,TelephoneDirectory::find($Transaction->name)->name);
                $Transaction->ref_id = $ref;
            }
        }

        return $Transactions;
    }
}
