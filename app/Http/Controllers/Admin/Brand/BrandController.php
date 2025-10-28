<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brands\BrandStoreRequest;
use App\Http\Requests\Admin\Brands\BrandUpdateRequest;
use App\Http\Resources\Admin\Brands\BrandResource;
use App\Http\Resources\Admin\Setting\BestBrandsResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class BrandController extends Controller
{
    public function index()
    {
        $brands = BrandResource::collection(Brand::latest()->paginate(20));
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
        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $URL = '/images/brands/' . $fileName;
        $image->move(public_path('images/brands/'), $fileName);
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

    public function update(BrandUpdateRequest $request)
    {
        $brand = Brand::whereId($request->id)->first();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            if (File::exists(public_path($brand->icon)))
                unlink(public_path($brand->icon));
            $image->move(public_path('images/brands/'), $fileName);
        }
        $brand->update([
            'name' => $request->name,
            'slug' => $request->name,
            'icon' => $request->hasFile('image') ? '/images/brands/' . $fileName : $brand->icon,
            'is_active' => $request->is_active,
        ]);
        return response()->json(['message' => 'success'], 200);
    }

    public function destroy($id)
    {
        $brand = Brand::whereId($id)->first();
        if ($brand->products->count() > 0)
            abort(400, 'این برند شامل محصول است!!!');
        if (File::exists(public_path($brand->icon))) {
            unlink(public_path($brand->icon));
        }
        $brand->delete();
        return response()->json(['message' => 'success'], 200);
    }

    public function show()
    {
        return response()->json(BrandResource::collection(Brand::latest()->get()), 200);
    }

    public function toggleToBest(int $id)
    {
        Brand::whereId($id)->update([
            'is_best' => DB::raw('NOT is_best')
        ]);
        return response()->json(BestBrandsResource::collection(Brand::orderBy('is_best', 'desc')->get()));
    }
}
