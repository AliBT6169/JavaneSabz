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

    public static function updateImage(string $type, int $id, UploadedFile $file,string $imagePath,string $fileName): void
    {
        $media = self::where('gallery_id', $id)->where('gallery_type', $type)->first();
        if ($media && File::exists($media->media))
            unlink($media->media);
        $file->move(public_path($imagePath), $fileName);
        self::updateOrCreate([
            'gallery_id' => $id,
            'gallery_type' => $type,
            'media' => $imagePath . $fileName
        ]);
    }
}
