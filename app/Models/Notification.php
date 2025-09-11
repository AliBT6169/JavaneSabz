<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'id',
        'title',
        'body',
        'seen',
        'created_at',
        'updated_at',
    ];
}
