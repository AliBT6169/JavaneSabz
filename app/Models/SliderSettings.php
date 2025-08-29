<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SliderSettings extends Model
{
    /** @use HasFactory<\Database\Factories\SliderSettingsFactory> */
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'image',
        'attribute_id',
        'status',
        'created_at'
    ];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
}
