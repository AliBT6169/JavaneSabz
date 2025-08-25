<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Banner extends Model
{
    protected $table = 'banners';
    protected $fillable = [
        'id',
        'attribute_id',
        'image',
        'title',
        'text',
        'is_active',
        'created_at',
    ];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }

}
