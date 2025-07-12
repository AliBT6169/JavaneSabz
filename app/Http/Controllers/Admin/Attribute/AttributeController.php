<?php

namespace App\Http\Controllers\Admin\Attribute;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Attribute\AttributeStoreRequest;
use App\Http\Resources\Admin\Attribute\AttributeResource;
use App\Models\Attribute;
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
        return response()->json($attribute, 201);
    }
}
