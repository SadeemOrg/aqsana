<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormMassage extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','name', 'message','phone','is_read'
        ];
        public function ActionEvents()
        {
            return $this->hasMany(ActionEvents::class,"actionable_id")->where('action_events.target_type', '=', get_class($this));
        }

}
