<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class NavItemSettingAttribute extends Model
{
    protected $table = "nav_item_setting_attributes";

    protected $fillable = [
        'id',
        'bav_bar_setting_id',
        'attribute_id',
        'created_at',
    ];

    public function attribute(): BelongsTo
    {
        return $this->belongsTo(Attribute::class);
    }
    public function navBarSetting(): BelongsTo
    {
        return $this->belongsTo(NavBarSetting::class);
    }
}
