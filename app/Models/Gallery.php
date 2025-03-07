<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Gallery extends Model
{
    /** @use HasFactory<\Database\Factories\GalleryFactory> */
    use HasFactory;

    protected $table = 'gallery';
    protected $fillable = [
        'id',
        'mediable_id',
        'mediable_type',
        'media',
    ];

    public function mediable(): morphTo
    {
        return $this->morphTo();
    }

    public static function updateImage($type, $image ,$id = 0)
    {
        if ($type == 'user') {
            if (file_exists(Auth::user()->gallery->media))
                unlink(Auth::user()->gallery->media);
            $URL = 'images/users/' . Auth::id() . '/' . $image->getClientOriginalName();
            $path = $image->move(public_path('images/users/' . Auth::id() . '/'), $image->getClientOriginalName());
            if (self::where('mediable_id', Auth::id())->exists())
                self::where('mediable_id', Auth::id())->update(['media' => $URL]);
            else
                self::create([
                    'mediable_id' => Auth::id(),
                    'mediable_type' => User::class,
                    'media' => $URL
                ]);
        }
    }
}
