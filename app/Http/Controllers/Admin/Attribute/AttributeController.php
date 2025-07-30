<?php

namespace App\Http\Controllers\Admin\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Attribute\AttributeStoreRequest;
use App\Http\Requests\Admin\Attribute\AttributeUpdateRequest;
use App\Http\Resources\Admin\Attribute\AttributeEditResource;
use App\Http\Resources\Admin\Attribute\AttributeResource;
use App\Models\Attribute;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = AttributeResource::collection(Attribute::latest()->paginate(10));
        return Inertia::render('Admin/pages/Attributes/index', ['Attributes' => $attributes]);
    }

    public function create()
    {
        return Inertia::render('Admin/pages/Attributes/create');
    }

    public function store(AttributeStoreRequest $request)
    {
        $image = $request->file('image');
        $lastId = DB::select('SHOW TABLE STATUS LIKE "attributes"')[0]->Auto_increment;
        $URL = '/images/attributes/' . $lastId . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images/attributes/'), $lastId . '.' . $image->getClientOriginalExtension());
        $attribute = Attribute::create([
            'name' => $request->name,
            'slug' => $request->name,
            'icon' => $URL,
            'description' => $request->description,
            'is_active' => $request->is_active
        ]);
//        attach brands
        if ($request->brand != null)
            foreach ($request->brand as $brandId) {
                $brand = Brand::whereId($brandId)->first();
                $attribute->brands()->attach($brand);
            }
//        attach categories
        if ($request->category != null)
            foreach ($request->category as $categoryId) {
                $category = Brand::whereId($categoryId)->first();
                $attribute->categories()->attach($category);
            }
//        attach products
        if ($request->product != null)
            foreach ($request->product as $productId) {
                $product = Brand::whereId($productId)->first();
                $attribute->products()->attach($product);
            }
//        attach product variations
        if ($request->product_variation != null)
            foreach ($request->product_variation as $product_variationId) {
                $product_variation = Brand::whereId($product_variationId)->first();
                $attribute->product_variations()->attach($product_variation);
            }
        return response()->json($attribute, 201);
    }

    public function toggle(int $id)
    {
        Attribute::whereId($id)->update([
            'is_active' => DB::raw('NOT is_active')
        ]);
        return response()->json('عملیات موفقیت آمیز بود!', 200);
    }

    public function edit(int $id)
    {
        $attribute = Attribute::whereId($id)->first();
        return Inertia::render('Admin/pages/Attributes/edit', ['attributeData' => AttributeEditResource::make($attribute)]);
    }

    public function update(AttributeUpdateRequest $request)
    {
        $attribute = Attribute::whereId($request->id)->first();
        $URL = '';
        if ($request->hasFile('image')) {
            unlink(public_path($attribute->icon));
            $image = $request->file('image');
            $URL = '/images/attributes/' . $request->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/attributes/'), $request->id . '.' . $image->getClientOriginalExtension());
        } else {
            $URL = $attribute->icon;
        }
        $attribute->update([
            'name' => $request->name,
            'slug' => $request->name,
            'icon' => $URL,
            'description' => $request->description,
            'is_active' => $request->is_active,
        ]);
        $attribute->brands()->sync($request->brand);
        $attribute->products()->sync($request->product);
        $attribute->categories()->sync($request->category);
        $attribute->product_variations()->sync($request->product_variation);
        return response()->json('موفقیت آمیز بود', 201);
    }

    public function destroy(int $id)
    {
        $attribute = Attribute::whereId($id)->first();
        if (File::exists(public_path($attribute->icon)))
            File::delete(public_path($attribute->icon));
        $attribute->brands()->detach();
        $attribute->categories()->detach();
        $attribute->products()->detach();
        $attribute->product_variations()->detach();
        $attribute->delete();
    }
}
