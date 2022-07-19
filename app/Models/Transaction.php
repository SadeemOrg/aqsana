<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    use HasFactory;

    protected $fillable = [
        'id','type', 'description','ref_id','transactions_type', 'transactions_status','Currency','equivalent_amount','date','reason_of_reject','approval','voucher'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'date' => 'date',

    ];

    public function Trip()
    {
        return $this->belongsTo('App\Models\Trip','ref_id');
    }


    public function Alhisalat()
    {
        return $this->belongsTo('App\Models\Alhisalat','ref_id');
    }



}
