<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionEvents extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_address','description','phone_number_address','status','current_location'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',

    ];

    public function myid()
    {
        return $this->id;
    }


}
