<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Course\CourseStoreRequest;
use App\Http\Requests\Course\AddMediaToCourseRequest;
use App\Http\Resources\Admin\Courses\CourseResource;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\JsonResponse;
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
        $courses = CourseResource::collection($this->courseService->getWithPagination(5));
        return Inertia::render('Admin/pages/Courses/index', ['courses' => $courses]);
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

    public function show(int $id): Response
    {
        $course = $this->courseService->findById($id);
        if (!$course)
            abort(404);
        return Inertia::render('CourseShow', ['course' => CourseResource::make($course)]);
    }

    public function publicPages()
    {

    }

    public function destroy(int $id): \Illuminate\Http\Response
    {
        if ($this->courseService->delete($id))
            return response()->noContent();
        else abort(500);
    }

    public function increaseView(int $id): \Illuminate\Http\Response
    {
        if ($this->courseService->increaseView($id))
            return response()->noContent();
        else abort(500);

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
