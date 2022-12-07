<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkHours extends Model
{
    use HasFactory;
    protected $fillable = [
'user_id','day','date','start_time','end_time',
'departure'

    ];
    protected $casts = [

        'date'=>'date',
        'departure' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
