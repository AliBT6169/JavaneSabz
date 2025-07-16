<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Orders\OrderIndexResource;
use App\Http\Resources\Admin\ProductVariations\ProductVariationsResource;
use App\Models\Order;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderData = OrderIndexResource::collection(Order::latest()->paginate(10));
        return Inertia::render('Admin/pages/Order/index', ['orderData' => $orderData]);
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
    public function edit(int $id)
    {
        $order = OrderIndexResource::make(Order::whereId($id)->first());
        return Inertia::render('Admin/pages/Order/edit', ['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        return response()->json($request, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function disable(int $id)
    {
        $order = Order::whereId($id)->first();
        $order->update(['status' => 4]);
        return response()->json('سفارش با موفقیت لغو شد!', 200);
    }

    public function getProducts(Request $request)
    {
        $productVariations = ProductVariationsResource::collection(ProductVariation::whereNotIn('id', $request)->latest()->get());
        $selectedProducts = ProductVariationsResource::collection(ProductVariation::whereIn('id', $request)->get());
        $products = [
            'products' => $productVariations,
            'selectedProducts' => $selectedProducts
        ];
        return $products;
    }
}
