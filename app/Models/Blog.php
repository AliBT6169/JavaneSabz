<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Blog extends Model
{
    protected $fillable = [
        'id',
        'user_id',
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

}
