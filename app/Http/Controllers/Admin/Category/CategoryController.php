<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\CategoryStoreRequest;
use App\Http\Resources\Admin\Categories\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryResource::collection(Category::latest()->get());
        return Inertia::render('Admin/pages/Categories/index', ['categories' => $categories]);
    }

    public function create()
    {
        return Inertia::render('Admin/pages/Categories/create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $image = $request->file('image');
        $lastId = DB::select('SHOW TABLE STATUS LIKE "categories"')[0]->Auto_increment;
        $URL = '/images/categories/' . $lastId . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/categories/'), $lastId . '.' . $image->getClientOriginalExtension());
        Category::create([
            'name' => $request->name,
            'slug' => $request->name,
            'description' => $request->decription,
            'icon' => $URL,
            'is_active' => $request->is_active,
        ]);
        return response()->json(['message' => 'success'], 200);
    }
}
