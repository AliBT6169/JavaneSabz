<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CallToAdmin extends Model
{
    protected $table = 'call_to_admins';
    protected $fillable = [
        'id',
        'name',
        'phone',
        'text',
    ];

}
