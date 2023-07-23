<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookType extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','name','describtion'

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
