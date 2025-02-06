<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';
    protected $fillable = [
        'id',
        'image',
        'title',
        'text',
        'priority',
        'is_active',
        'type',
        'button_text',
        'button_link',
        'button_icon',
        'created_at',
    ];

}
