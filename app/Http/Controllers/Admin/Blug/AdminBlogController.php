<?php

namespace App\Http\Controllers\Admin\Blug;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Blug\AdminBlogIndexResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminBlogController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/pages/Blogs/index', ['blogs' => AdminBlogIndexResource::collection(Blog::latest()->get())]);
    }

}
