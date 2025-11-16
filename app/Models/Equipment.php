<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    protected $table = 'equipments';
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_equipments','equipment_id', 'product_id');
    }
}
