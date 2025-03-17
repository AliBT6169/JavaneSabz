<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\DashboardResource;
use App\Models\Address;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
//        validation section
        $validatedData = $request->validate([
            'username' => 'required',
            'full_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::id()),
            ],
            'image' => 'required|image|max:2048',
            'address' => 'required',
            'mobile' => 'required',
            'gender' => 'required|in:0,1',
            'post_code' => 'required',
        ]);
//        image section
        Gallery::updateImage(User::class, $validatedData['image']);
//        user update section
        User::updateUser($validatedData);
//        address update or create section
        Address::addressStore($request->id, $validatedData['address'], $validatedData['post_code'],User::class);
        return DashboardResource::make(User::whereId(Auth::id())->first());
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
}
