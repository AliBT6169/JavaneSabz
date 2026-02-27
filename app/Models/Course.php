<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\File;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = [
        'title',
        'subject',
        'avatar',
        'content',
        'views',
    ];

    public function Galleries(): MorphMany
    {
        return $this->morphMany(Gallery::class, 'gallery');
    }

    public static function booted()
    {
        static::deleting(function ($course) {
            if (count($course->Galleries) > 0)
                $course->Galleries()->delete();
            if (File::exists(public_path($course->avatar)))
                File::delete(public_path($course->avatar));
        });
    }
}
