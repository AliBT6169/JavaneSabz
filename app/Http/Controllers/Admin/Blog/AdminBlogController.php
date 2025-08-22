<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blogs\BlogStoreRequest;
use App\Http\Requests\Admin\Blogs\BlogUpdateRequest;
use App\Http\Resources\Admin\Blog\AdminBlogIndexResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AdminBlogController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/pages/Blogs/index', ['blogs' => AdminBlogIndexResource::collection(Blog::latest()->get())]);
    }

    public function create()
    {
        return Inertia::render('Admin/pages/Blogs/create');
    }

    public function store(BlogStoreRequest $request)
    {
        $blog = Blog::create([
            'user_id' => 5,
            'title' => $request->title,
            'slug' => $request->title,
            'description' => $request->description,
            'status' => $request->status
        ]);
        return [
            'message' => 'عملیات ذخیره بلاگ موفقیت آمیز بود',
            'data' => $blog->description,
            'status' => 200,
        ];
    }

    public function edit(int $id)
    {
        $blog = AdminBlogIndexResource::make(Blog::whereId($id)->first());
        Inertia::render('Admin/pages/Blogs/edit.vue', ['data' => $blog]);
    }

    public function update(BlogUpdateRequest $request)
    {
        $blog = Blog::whereId($request->id)->first()->update([
            'title' => $request->title,
            'slug' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return response()->json([
            'message' => 'ملیات به روز رسانی بلاگ موفقیت آمیز بودع',
            'data' => $blog->description,
            'status' => 201,
        ]);
    }

}
