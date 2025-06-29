<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function searchPage()
    {
        return Inertia::render('SearchPage');
    }

    public function search($input = '')
    {
        return Product::search($input);
    }
}
