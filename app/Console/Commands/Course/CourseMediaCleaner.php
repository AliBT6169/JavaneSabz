<?php

namespace App\Console\Commands\Course;

use App\Models\Gallery;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class CourseMediaCleaner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:course-media-cleaner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $medias = Cache::get('course_media');
        if ($medias) {
            foreach ($medias as $media) {
                $gallery = Gallery::whereId($media)->first();
                if ($gallery && $gallery->gallery_id == 10000) {
                    if (File::exists(public_path($gallery->media))) {
                        File::delete(public_path($gallery->media));
                    }
                    $gallery->delete();
                }
            }
            Cache::forget('course_media');
        }
    }
}
