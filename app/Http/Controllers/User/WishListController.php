<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function delete($id)
    {
        return WishList::whreId($id)->destroy();
    }
}
