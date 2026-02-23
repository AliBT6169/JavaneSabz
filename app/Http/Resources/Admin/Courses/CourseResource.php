<?php

namespace App\Http\Resources\Admin\Courses;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'avatar' => url($this->avatar),
            'subject' => $this->subject,
            'content' => $this->content,
            'views' => $this->views,
        ];
    }
}
