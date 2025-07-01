<?php

namespace App\Http\Controllers\Admin\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Attribute\AttributeResource;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AttributeController extends Controller
{
    public function index()
    {
        $attributes = AttributeResource::collection(Attribute::where('is_active', 1)->latest()->get());
        return Inertia::render('Admin/pages/Attributes/index', ['attributes' => $attributes]);
    }
}
