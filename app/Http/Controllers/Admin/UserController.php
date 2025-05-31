<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Resources\Admin\UserResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $userData = UserResource::collection(User::latest()->paginate(10));
        return Inertia::render('Admin/pages/Users/index', ['userData' => $userData]);
    }

    public function destroy($id)
    {
        User::destroy($id);
        return [
            'status' => 200,
            'message' => 'User deleted'
        ];
    }

    public function edit($id)
    {
        $user = UserResource::make(User::whereId($id)->first());
        return Inertia::render('Admin/pages/Users/edit', ['user' => $user]);
    }

    public function update(UserRequest $request)
    {
        //user update
        $user = User::whereId($request->id)->first()->update([
            'full_name' => $request->full_name,
            'name' => $request->user_name,
            'email' => $request->email,
            'cellphone' => $request->cellphone,
            'gender' => $request->gender,
        ]);
        $address = Address::where('addressable_id', $request->id)->where('addressable_type', User::class)->first();
        if ($address) {
            $address_validate = $request->validate([
                'address' => 'required',
                'city' => 'required',
                'post_code' => 'required',
            ]);
            $address->update([
                'city_id' => $request->city,
                'address' => $request->address,
                'post_code' => $request->post_code,
            ]);
            return $address;
        } else {
            $address = Address::create([
                'addressable_id' => $request->id,
                'addressable_type' => User::class,
                'city_id' => $request->city,
                'address' => $request->address ?? '',
                'post_code' => $request->post_code ?? '1234567890',
            ]);
            return $address;
        }
    }
}
