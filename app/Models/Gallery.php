<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Gallery extends Model
{
    /** @use HasFactory<\Database\Factories\GalleryFactory> */
    use HasFactory;

    protected $table = 'gallery';
    protected $fillable = [
        'id',
        'gallery_id',
        'gallery_type',
        'media',
    ];

    public function galleryable(): morphTo
    {
        return $this->morphTo();
    }

    public static function updateImage($type, $image, $id = 0)
    {
        $user = Auth::user();
        if ($id != 0) {
            $user = User::whereId($id)->first();
        } else {
            $id = Auth::id();
        }
        if ($type == User::class) {
            if ($user->gallery != null)
                unlink(($user->gallery->media) ?? '');
            $URL = 'images/users/' . $id . '/' . $image->getClientOriginalName();
            $path = $image->move(public_path('images/users/' . $id . '/'), $image->getClientOriginalName());
            if (self::where('gallery_id', $id)->where('gallery_type', $type)->exists())
                self::where('gallery_id', $id)->update(['media' => $URL]);
            else
                self::create([
                    'gallery_id' => $id,
                    'gallery_type' => $type,
                    'media' => $URL
                ]);
        }
    }
}
