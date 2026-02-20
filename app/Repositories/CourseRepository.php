<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository
{
    public function __construct(protected Course $model)
    {
        //
    }

    public function create(string $subject, string $title, string $content): Course
    {
        return $this->model::query()->create([
            'subject' => $subject,
            'title' => $title,
            'content' => $content,
        ]);
    }
}
