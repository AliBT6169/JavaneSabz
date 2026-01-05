<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'title',
        'subject',
        'content',
        'views',
    ];

    public function Galleries(): MorphMany
    {
        return $this->morphMany(Gallery::class, 'gallery');
    }
}
