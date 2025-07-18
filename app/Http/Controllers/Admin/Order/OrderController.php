<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Orders\OrderUpdateRequest;
use App\Http\Resources\Admin\Orders\OrderIndexResource;
use App\Http\Resources\Admin\ProductVariations\ProductVariationsResource;
use App\Models\DeliveryAmount;
use App\Models\Order;
use App\Models\OrderItem;
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
        return Inertia::render('Admin/pages/Order/create');
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
    public function update(OrderUpdateRequest $request)
    {
        $order = Order::whereId($request->id)->first();
        $orderIdes = [];
        $newOrderItems = [];
        foreach ($request->items as $item) {
            if ($item['order_item_id'] != -1)
                $orderIdes[] = $item['order_item_id'];
            else {
                $newOrderItems = OrderItem::create([
                    'order_id' => $request->id,
                    'product_variation_id' => $item['id'],
                    'quantity' => $item['order_quantity'],
                    'price' => ProductVariation::whereId($item['id'])->first()->sale_price,
                ]);
                $orderIdes[] = $newOrderItems['id'];
            }
        }
        $orderItems = OrderItem::whereIn('id', $orderIdes)->get();
        $orderAllItems = $order->orderItems;
        foreach ($orderAllItems as $orderItem) {
            $searchItem = false;
            foreach ($orderItems as $newOrderItem) {
                if ($newOrderItem->id == $orderItem->id) {
                    $searchItem = true;
                }
            }
            foreach ($request->items as $item) {
                if ($item['order_item_id'] == $orderItem->id && $item['order_quantity'] != $orderItem->quantity) {
                    $orderItem->update([
                        'quantity' => $item['order_quantity'],
                    ]);
                }
            }
            if (!$searchItem) {
                $orderItem->delete();
            }
        }
        $orderPrice = 0;
        foreach ($orderItems as $orderItem) {
            $orderPrice += $orderItem->price * $orderItem->quantity;
        }
        $deliveryAmount = DeliveryAmount::getOrderDeliveryAmount(['id' => $order->id]);
        $payment_status = $request->status == -1 ? 0 : 1;
        $status = $request->status <= 0 ? 0 : $request->status;
        $VAT = (int)($deliveryAmount['deliveryAmount'] + $orderPrice) * 15 / 100;
        $order->update([
            'status' => $status,
            'total_amount' => $orderPrice,
            'delivery_amount' => $deliveryAmount['deliveryAmount'],
            'VAT' => $VAT,
            'coupon_amount' => $request->coupon_amount,
            'paying_amount' => $deliveryAmount['deliveryAmount'] + $orderPrice + $VAT - $request->coupon_amount,
            'payment_status' => $payment_status,
        ]);
        return response()->json('عملیات بروزرسانی سفارش کاربر موفقیت آمیز بود!', 200);
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
