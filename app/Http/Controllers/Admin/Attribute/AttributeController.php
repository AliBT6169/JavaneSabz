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
        $attributes = AttributeResource::collection(Attribute::latest()->get());
        return Inertia::render('Admin/pages/Attributes/index', ['Attributes' => $attributes]);
    }

    public function create()
    {
        return Inertia::render('Admin/pages/Attributes/create');
    }

    public function store($request)
    {
        return $request;
    }
}
