<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppNotification extends Model
{
    use HasFactory;
      // The table associated with the model.
      protected $table = 'app_notifications';

      // The attributes that are mass assignable.
      protected $fillable = ['user_id', 'title', 'body', 'date'];
}
