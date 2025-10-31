<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\CategoryStoreRequest;
use App\Http\Requests\Admin\Categories\CategoryUpdateRequest;
use App\Http\Resources\Admin\Categories\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryResource::collection(Category::latest()->paginate(20));
        return Inertia::render('Admin/pages/Categories/index', ['categories' => $categories]);
    }

    public function create()
    {
        return Inertia::render('Admin/pages/Categories/create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $image = $request->file('image');
        $URL = '/images/categories/';
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/categories/'), $imageName);
        $URL = $URL . $imageName;
        Category::create([
            'name' => $request->name,
            'slug' => $request->name,
            'description' => $request->description,
            'icon' => $URL,
            'is_active' => $request->is_active,
        ]);
        return response()->json(['message' => 'success'], 200);
    }


    public function toggle($id)
    {
        Category::whereId($id)->update([
            'is_active' => DB::raw('NOT is_active')
        ]);
        return response()->json(['message' => 'عملیات موفقیت آمیز بود'], 200);
    }

    public function edit($id)
    {
        $category = CategoryResource::make(Category::whereId($id)->first());
        return Inertia::render('Admin/pages/Categories/edit', ['categoryData' => $category]);
    }


    public function update(CategoryUpdateRequest $request)
    {
        $categories = Category::whereId($request->id)->first();
        $URL = $categories->icon;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            if (File::exists(public_path($categories->icon)))
                unlink(public_path($categories->icon));
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/categories/'), $imageName);
            $URL = '/images/categories/' . $imageName;
        }
        $categories->update([
            'name' => $request->name,
            'slug' => $request->name,
            'icon' => $URL,
            'description' => $request->description,
            'is_active' => $request->is_active,
        ]);
        return response()->json(['message' => 'success'], 200);
    }

    public function destroy($id)
    {
        $category = Category::whereId($id)->first();
        if ($category->products->count() > 0)
            abort(400, 'این دسته بندی شامل محصول است!!!');
        if (File::exists(public_path($category->icon)))
            unlink(public_path($category->icon));
        $category->delete();
        return response()->json(['message' => 'success'], 200);
    }

    public function show()
    {
        return response()->json(CategoryResource::collection(Category::latest()->get()), 200);
    }
}
