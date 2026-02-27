<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Pagination\LengthAwarePaginator;

class CourseRepository
{
    public function __construct(protected Course $model)
    {
        //
    }

    public function create(string $subject, string $title, string $avatarUrl, string $content): Course
    {
        return $this->model::query()->create([
            'subject' => $subject,
            'avatar' => $avatarUrl,
            'title' => $title,
            'content' => $content,
        ]);
    }

    public function findById(int $id): ?Course
    {
        return $this->model::query()->find($id) ?? null;
    }

    public function increaseView(int $id): bool
    {
        $course = $this->findById($id);
        if ($course && $course->update(['views' => $course->views + 1]))
            return true;
        return false;
    }

    public function getWithPagination(int $count): LengthAwarePaginator
    {
        return $this->model::query()->latest()->paginate($count);
    }

    public function delete(int $courseId): bool
    {
        return $this->model::query()->find($courseId)->delete();
    }
}
