<?php

namespace App\Http\Controllers\Admin\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Attribute\AttributeStoreRequest;
use App\Http\Resources\Admin\Attribute\AttributeResource;
use App\Models\Attribute;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = AttributeResource::collection(Attribute::latest()->get());
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
}
