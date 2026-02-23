<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Gallery;
use App\Repositories\CourseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Symfony\Component\DomCrawler\Crawler;

class CourseService
{
    public function __construct(protected CourseRepository $repository)
    {
        //
    }

    public function addMedia(array $mediaData): string
    {
        $file = $mediaData['file'];
        $fileName = uniqid() . '.' . $file->extension();
        $path = '';
        $publicPath = '';
        if ($mediaData['type'] === 'image') {
            $path = $file->move(public_path('images/course'), $fileName);
            $publicPath = '/images/course/' . $fileName;
        } else if ($mediaData['type'] === 'video') {
            $path = $file->move(public_path('videos/course'), $fileName);
            $publicPath = '/videos/course/' . $fileName;
        }
        $gallery = Gallery::query()->create([
            'gallery_id' => 10000,
            'gallery_type' => Course::class,
            'media' => $publicPath,
        ]);
        $allMediaCaches = Cache::get('course_media');
        if ($allMediaCaches) {
            $allMediaCaches[] = $gallery->id;
            Cache::put('course_media', $allMediaCaches);
        } else {
            $allMediaCaches[] = $gallery->id;
            Cache::put('course_media', $allMediaCaches);
        }
        return $publicPath;
    }

    public function createCourse(array $data): bool
    {
        if (!isset($data['avatar']))
            return false;
        File::ensureDirectoryExists(public_path('images/course'));
        $fileName = uniqid() . '.' . $data['avatar']->getClientOriginalExtension();
        $url = 'images/course/' . $fileName;
        $data['avatar']->move(public_path('images/course'), $fileName);
        $course = $this->repository->create(
            subject: $data['subject'],
            title: $data['title'],
            avatarUrl: $url,
            content: $data['content']
        );
        $crawler = new Crawler($data['content']);
        $videoUrls = $crawler->filter('video')->each(function (Crawler $node) {
            return $node->attr('src');
        });
        $imageUrls = $crawler->filter('img')->each(function (Crawler $node) {
            return $node->attr('src');
        });
        $allMedia = array_merge($videoUrls, $imageUrls);
        $galleries = Gallery::query()->whereIn('media', $allMedia)->get();
        foreach ($galleries as $gallery) {
            $gallery->update(['gallery_id' => $course->id]);
        }
        return true;
    }

    public function getWithPagination(int $count): LengthAwarePaginator
    {
        return $this->repository->getWithPagination($count);
    }

    public function delete(int $courseId): bool
    {
        return $this->repository->delete($courseId);
    }
}
