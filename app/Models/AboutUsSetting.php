<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsSetting extends Model
{
    /** @use HasFactory<\Database\Factories\AboutUsSettingFactory> */
    use HasFactory;

    protected $table = 'about_us_settings';

    protected $fillable = [
        'id',
        'owner_name',
        'owner_image',
        'store_image',
        'description',
        'created_at',
    ];

}
