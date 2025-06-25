<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Brands\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BrandController extends Controller
{
    public function index()
    {
        $brands = BrandResource::collection(Brand::latest()->paginate(20));
        return Inertia::render('Admin/pages/Brands/index', ['brands' => $brands]);
    }
}
