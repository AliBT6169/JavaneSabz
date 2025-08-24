<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blogs\BlogStoreRequest;
use App\Http\Requests\Admin\Blogs\BlogUpdateRequest;
use App\Http\Resources\Admin\Blog\AdminBlogIndexResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AdminBlogController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/pages/Blogs/index', ['blogs' => AdminBlogIndexResource::collection(Blog::latest()->paginate(10))]);
    }

    public function create()
    {
        return Inertia::render('Admin/pages/Blogs/create');
    }

    public function store(BlogStoreRequest $request)
    {
        $image = $request->file('icon');
        $lastId = DB::select('SHOW TABLE STATUS LIKE "blogs"')[0]->Auto_increment;
        $URL = '/images/blogs/' . $lastId . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/blogs/'), $lastId . '.' . $image->getClientOriginalExtension());
        $blog = Blog::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => $request->title,
            'icon' => $URL,
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
        return Inertia::render('Admin/pages/Blogs/edit', ['data' => $blog]);
    }

    public function update(BlogUpdateRequest $request)
    {
        $blog = Blog::whereId($request->id)->first();
        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            unlink(public_path('images/blogs/' . $blog->id . '.' . $image->getClientOriginalExtension()));
            $image->move(public_path('images/blogs/'), $blog->id . '.' . $image->getClientOriginalExtension());
        }
        $blog->update([
            'title' => $request->title,
            'slug' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return response()->json([
            'message' => 'ملیات به روز رسانی بلاگ موفقیت آمیز بودع',
            'data' => $request->description,
            'status' => 201,
        ]);
    }

    public function destroy(int $id)
    {
        $blog = Blog::whereId($id)->first();
        if ($blog) {
            $blog->delete();
            return response()->json('عملیات حذف وبلاگ موفقیت آمیز بود');
        }
        abort(404, 'وبلاگ مورد نظر یافت نشد!!!');
    }

}
