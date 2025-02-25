<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\DashboardResource;
use App\Models\Address;
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
        $validatedData = $request->validate([
            'name' => 'required',
            'full_name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(Auth::id()),
            ],
            'image' => 'required|image|max:2048',
            'address' => 'required',
            'cellphone' => 'required',
            'gender' => 'required|in:0,1',
            'post_code' => 'required',
        ]);
        $image = $request->image;
        $URL = 'images/users/' . $request->name . '/' . $image->getClientOriginalName();
        $path = $image->move(public_path('images/users/' . $request->name . '/'), $image->getClientOriginalName());
        User::whereId(Auth::id())->update([
            'name' => $validatedData['name'],
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'avatar' => $URL,
            'cellphone' => $validatedData['cellphone'],
            'gender' => $validatedData['gender'],
        ]);
        if (Address::where('addressable_id', Auth::id())->exists())
            Address::where('addressable_id', Auth::id())->update([
                'address' => $validatedData['address'],
                'postcode' => $validatedData['post_code'],
            ]);
        else
            Address::create([
                'addressable_id' => Auth::id(),
                'address' => $validatedData['address'],
                'postcode' => $validatedData['post_code'],
            ]);
        return json_encode(DashboardResource::make(Auth::user()));
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
