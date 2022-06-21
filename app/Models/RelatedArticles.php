<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedArticles extends Model
{
    use HasFactory;

    protected $fillable = [
        'id','title','description','image'
    ];
    protected $casts = [
    	'pictures' => 'array',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',

    ];
}
