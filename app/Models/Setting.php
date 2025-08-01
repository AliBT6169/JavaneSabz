<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $fillable = [
        'id',
        'address',
        'phone',
        'icon',
        'email',
        'about',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
        'telegram',
        'whatsapp',
        'eta',
        'created_at',
    ];
}
