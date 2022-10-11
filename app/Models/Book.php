<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','file','cover_photo','name','author','description','post',

        ];
        protected $hidden = [
            'created_at',
            'updated_at',
        ];
        protected $casts = [
            'type' => 'array',
        ];

}
