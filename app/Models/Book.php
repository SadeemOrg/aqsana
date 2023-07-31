<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','file','cover_photo','name','author','description','post','type'

        ];
        protected $hidden = [
            'created_at',
            'updated_at',
        ];
        protected $casts = [
            // 'type' => 'array',
        ];

        public function BookType()
        {
            return $this->belongsTo('App\Models\BookType','type');
        }
        public function ActionEvents()
        {
            return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
        }


}
