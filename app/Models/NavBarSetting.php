<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NavBarSetting extends Model
{
    /** @use HasFactory<\Database\Factories\NavBarSettingFactory> */
    use HasFactory;

    protected $table = 'nav_bar_settings';

    protected $fillable = [
        'id',
        'title',
        'link',
        'icon',
        'queue',
        'is_active',
        'created_at',
    ];
}
