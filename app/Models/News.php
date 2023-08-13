<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Observers\NewsObserver;
use App\Observers\ProjectObserver;

class News extends Model
{
    use HasFactory;
    protected $observers = [
        News::class => [NewsObserver::class]


    ];
    protected $fillable = [

        'id','title','description','image','type','pictures','created_by','update_by','created_at','status'

    ];

    protected $casts = [
    	'pictures' => 'array',
        'new_date' => 'date',
        'main_type' => 'array',
    ];


    protected $hidden = [
        'updated_at',

    ];

    public function newsTypes()
    {
        return $this->belongsTo('App\Models\newsType','type');
    }
    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }

}
