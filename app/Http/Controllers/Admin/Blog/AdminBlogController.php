<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Blog\AdminBlogIndexResource;
use App\Models\Blog;
use Illuminate\Http\Request;
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

    public function store(Request $request)
    {
        return $request;
    }
}
