<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Alhisalat extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','name', 'city_id','description','amount_total', 'status','lat','lon','information_location','start_time', 'end_time','recipient','giver','approval','reason_of_reject'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'start_time' => 'date',
        'end_time' => 'date',
        'bus_id' => 'array',
    ];

    public function City()
    {
        return $this->belongsTo('App\Models\City','city_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','giver');
    }


    public function Transaction()
    {
        $users = DB::table('users')
            ->join('transactions', 'users.id', '=', 'transactions.id')

            ->select('users.*');
        return  $users;
    }






}
