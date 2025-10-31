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

    public static function updateImage(string $gallery_type, int $gallery_id, UploadedFile $file, string $imagePath, string $fileName): void
    {
        $media = self::where('gallery_id', $gallery_id)->where('gallery_type', $gallery_type)->first();
        if ($media && File::exists($media->media))
            unlink($media->media);
        $file->move(public_path($imagePath), $fileName);
        self::updateOrCreate([
            'gallery_id' => $gallery_id,
            'gallery_type' => $gallery_type,
            'media' => $imagePath . $fileName
        ]);
    }

    public static function deleteMedia(int $gallery_able_id, string $gallery_able_type): void
    {
        $galleries = self::where('gallery_id', $gallery_able_id)->where('gallery_type', $gallery_able_type)->get();
        foreach ($galleries as $gallery) {
            if ($gallery && File::exists(public_path($gallery->media))) {
                unlink(public_path($gallery->media));
                $path = explode('/', $gallery->media);
                $endPath = end($path);
                $path = str_replace($endPath, '', $gallery->media);
                if (count(File::files(public_path($path))) == 0) {
                    File::deleteDirectory(public_path($path));
                }
            }
            $gallery->delete();
        }
    }

    public static function deleteWithId(int $gallery_id): bool
    {
        $gallery = self::whereId($gallery_id)->first();
        if ($gallery) {
            if (File::exists(public_path($gallery->media))) {
                unlink(public_path($gallery->media));
                $path = explode('/', $gallery->media);
                $endPath = end($path);
                $path = str_replace($endPath, '', $gallery->media);
                if (count(File::files(public_path($path))) == 0)
                    File::deleteDirectory(public_path($path));
            }
            return $gallery->delete();
        }
        return false;
    }
}
