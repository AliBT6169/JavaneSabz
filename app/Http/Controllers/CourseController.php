<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\CourseStoreRequest;
use App\Http\Requests\Course\AddMediaToCourseRequest;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CourseController extends Controller
{
    public function __construct(protected CourseService $courseService)
    {
        //
    }

    public function index(): Response
    {
        return Inertia::render('Admin/pages/Courses/index', []);
    }

    public function create(): Response
    {
        return Inertia::render('Admin/pages/Courses/create', []);
    }

    public function store(CourseStoreRequest $request)
    {
        $validated = $request->validated();
        if ($this->courseService->createCourse($validated))
            return response()->json([
                'success' => true,
            ]);
        else abort(500);
    }

    public function show(Course $course)
    {

    }

    public function publicPages()
    {

    }

    public function addMedia(AddMediaToCourseRequest $request)
    {
        $validated = $request->validated();
        $mediaPath = $this->courseService->addMedia($validated);
        return response()->json([
            'success' => true,
            'type' => $validated['type'],
            'url' => $mediaPath,
        ]);
    }
}
