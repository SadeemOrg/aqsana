<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchiveSms extends Model
{
    use HasFactory;
    protected $fillable = [
        'send_type',
        'content',
        'date',
        'number_of_people',
        'sender_id',
    ];
    protected $casts = [
        'date' => 'datetime',
    ];
    public function sender()
    {
        return $this->belongsTo(User::class);
    }
}
