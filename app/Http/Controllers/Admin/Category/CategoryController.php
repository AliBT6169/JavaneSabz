<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Categories\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = CategoryResource::collection(Category::latest()->get());
        return Inertia::render('Admin/pages/Categories/index', ['categories' => $categories]);
    }
}
