<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Blog extends Model
{
    protected $fillable = [
        'id',
        'title',
        'slug',
        'description',
        'status',
        'created_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function gallery(): MorphMany
    {
        return $this->morphMany(Gallery::class, 'gallery');
    }
}
