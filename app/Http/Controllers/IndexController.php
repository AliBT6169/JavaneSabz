<?php

namespace App\Http\Controllers;

use App\Http\Resources\Home\Blog\BlogShowResource;
use App\Http\Resources\Home\Blog\IndexBlogResource;
use App\Http\Resources\Home\IndexSettingResource;
use App\Http\Resources\Home\NavigationSettingResource;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\NavBarSetting;
use App\Models\ProductVariation;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $indexData = [
            "products" => ProductVariation::getSomeProduct(20),
            "brands" => Brand::where('is_active', 1)->get(),
            "settings" => [
                "settings" => IndexSettingResource::make(Setting::first()),
                "NavSetting" => NavigationSettingResource::collection(NavBarSetting::where('is_active', true)->orderBy('queue', 'asc')->get()),
            ],
        ];
        return Inertia::render('Index', ["indexData" => $indexData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function blogs()
    {
        $blogs = IndexBlogResource::collection(Blog::where('status', 1)->latest()->paginate(20));
        return Inertia::render('Blogs', ['blogs' => $blogs]);
    }

    public function blogShow(int $id,string $slug)
    {

        $blog = Blog::whereId($id)->first();
        if ($blog->slug != $slug) {
            return Inertia::location(route('blogs.show', ['id' => $id, 'slug' => $blog->product->slug]));
        }
        return Inertia::render('BlogShow', ["blog" => BlogShowResource::collection($blog)]);
    }
}
