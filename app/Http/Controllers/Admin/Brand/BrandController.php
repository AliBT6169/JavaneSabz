<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brands\BrandStoreRequest;
use App\Http\Resources\Admin\Brands\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class BrandController extends Controller
{
    public function index()
    {
        $brands = BrandResource::collection(Brand::latest()->get());
        return Inertia::render('Admin/pages/Brands/index', ['brands' => $brands]);
    }

    public function toggle($id)
    {
        Brand::whereId($id)->update([
            'is_active' => DB::raw('NOT is_active')
        ]);
        return response()->json(['message' => 'عملیات موفقیت آمیز بود'], 200);
    }

    public function create()
    {
        return Inertia::render('Admin/pages/Brands/create');
    }

    public function store(BrandStoreRequest $request)
    {
        $image = $request->file('image');
        $lastId = 1;
        if (Brand::latest()->first() != null) {
            $lastId = Brand::latest()->first()->id + 1;
        }
        $URL = '/images/brands/' . $lastId . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/brands/'), $lastId . '.' . $image->getClientOriginalExtension());
        Brand::create([
            'name' => $request->name,
            'slug' => $request->name,
            'icon' => $URL,
            'is_active' => $request->is_active,
        ]);
        return response()->json(['message' => 'success'], 200);
    }

    public function edit(int $id)
    {
        $brandData = BrandResource::make(Brand::whereId($id)->first());
        return Inertia::render('Admin/pages/Brands/edit', ['brandData' => $brandData]);
    }
}
