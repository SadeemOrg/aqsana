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

    public function ActionEvents()
    {
        return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
    }

}
