<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\NewsObserver;
class News extends Model
{
    use HasFactory;

    protected $observers = [
        News::class => [NewsObserver::class],
    ];
    protected $fillable = [
        'id','title','description','image','type','pictures','created_by','update_by'
    ];

    protected $casts = [
    	'pictures' => 'array',
    ];


    protected $hidden = [
        'created_at',
        'updated_at',

    ];

    public function newsTypes()
    {
        return $this->belongsTo('App\Models\newsType','type');
    }
}
