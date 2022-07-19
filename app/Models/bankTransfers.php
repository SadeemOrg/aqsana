<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bankTransfers extends Model
{
    use HasFactory;


    protected $fillable = [
    'id','project_id','donername','Location','identity_number','iban','swift_code',
    'amount','transaction_date','currency_id','Created_By','Update_By'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'transaction_date' => 'date',


    ];
}
