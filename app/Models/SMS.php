<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    protected $table = 's_m_s';

    protected $fillable = [
        'message',
        'status',
    ];

    public static function booted()
    {
        static::addGlobalScope('created_desc', fn($query) => $query->orderBy('created_at', 'desc'));
    }
}
