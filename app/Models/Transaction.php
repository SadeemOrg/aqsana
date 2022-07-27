<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    use HasFactory;

    protected $fillable = [
        'id','type', 'description','ref_id','transactions_type', 'transactions_status','Currency','equivalent_amount','date','reason_of_reject','approval','voucher','transaction_date'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'transaction_date' => 'date',

    ];

    public function Trip()
    {
        return $this->belongsTo('App\Models\Trip','ref_id');
    }


    public function project()
    {
        return $this->belongsTo('App\Models\project','project_id');
    }

    public function Currenc()
    {
        return $this->belongsTo('App\Models\Currency','Currency');
    }

    // public function getCountryName() {
    //     return Currency::where('id', $this->id)->first()->name;
    // }

}
