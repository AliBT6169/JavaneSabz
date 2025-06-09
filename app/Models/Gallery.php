<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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

    public static function updateImage($type, UploadedFile $image, $id = 0)
    {
        if ($type == User::class) {
            $user = Auth::user();
            if ($id != 0) {
                $user = User::whereId($id)->first();
            } else {
                $id = Auth::id();
            }
            if ($user->gallery != null)
                if (File::exists($user->gallery->media))
                    unlink(($user->gallery->media));
            $URL = '/images/users/' . $id . '/' . $image->getClientOriginalName();
            $path = $image->move(public_path('images/users/' . $id . '/'), $image->getClientOriginalName());
            if (self::where('gallery_id', $id)->where('gallery_type', $type)->exists())
                self::where('gallery_id', $id)->update(['media' => $URL]);
            else
                self::create([
                    'gallery_id' => $id,
                    'gallery_type' => $type,
                    'media' => $URL
                ]);
        } elseif ($type == ProductVariation::class) {
            $before_images = self::where('gallery_id', $id)->where('gallery_type', $type)->get();
            $URL = '/images/productVariations/' . $id . '/' . $before_images->count() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/productVariations/' . $id . '/'), $before_images->count() . '.' . $image->getClientOriginalExtension());
            self::create([
                'gallery_id' => $id,
                'gallery_type' => $type,
                'media' => $URL
            ]);
        }
    }
}
