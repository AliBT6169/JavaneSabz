<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
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
}
