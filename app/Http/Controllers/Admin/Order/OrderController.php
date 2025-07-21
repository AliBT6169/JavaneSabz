<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Orders\OrderStoreRequest;
use App\Http\Requests\Admin\Orders\OrderUpdateRequest;
use App\Http\Resources\Admin\Orders\OrderIndexResource;
use App\Http\Resources\Admin\ProductVariations\CreateOrderProductVariationsResource;
use App\Models\Address;
use App\Models\City;
use App\Models\DeliveryAmount;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    public function store(OrderStoreRequest $request)
    {
        $payment_status = $request->status == -1 ? 0 : 1;
        $status = $request->status <= 0 ? 0 : $request->status;
        $ides = [];
        foreach ($request->items as $item) {
            $ides[] = $item['id'];
        }
        $products = ProductVariation::whereIn('id', $ides)->get();
        $totalAmount = 0;
        $deliveryAmount = 0;
        foreach ($products as $product) {
            foreach ($request->items as $item) {
                if ($item['id'] == $product->id) {
                    $totalAmount += $product->sale_price * $item['order_quantity'];
                    $deliveryAmount = DeliveryAmount::getPrice($product->weight) * $item['order_quantity'];
                }
            }
        }
        $city = City::whereId($request->city)->first();
        $province_percentage = DeliveryAmount::getProvincePercentage($city->province->name);
        $city_percentage = DeliveryAmount::getBigCityPercentage($city->name);
        $deliveryAmount += $city_percentage * $deliveryAmount / 100;
        $deliveryAmount += $province_percentage * $deliveryAmount / 100;
        $payingAmount = $totalAmount + $deliveryAmount;
        $payingAmount -= $request->coupon_amount;
        $VAT = $payingAmount * 15 / 100;
        $payingAmount += $VAT;
        $order = Order::create([
            'code' => DB::select('SHOW TABLE STATUS LIKE "orders"')[0]->Auto_increment + 10000,
            'user_id' => $request->user,
            'status' => $status,
            'total_amount' => $totalAmount,
            'delivery_amount' => $deliveryAmount,
            'VAT' => $VAT,
            'coupon_amount' => $request->coupon_amount,
            'paying_amount' => $payingAmount,
            'payment_status' => $payment_status,
        ]);
        Address::create([
            'address' => $request->address,
            'postcode' => $request->postal_code,
            'addressable_id' => $order->id,
            'addressable_type' => Order::class,
            'city_id' => $request->city,
        ]);
        foreach ($products as $product) {
            foreach ($request->items as $item) {
                if ($item['id'] == $product->id) {
                    if ($request->status >= 0)
                        $product->update([
                            'quantity' => $product->quantity - $item['order_quantity'],
                        ]);
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_variation_id' => $product->id,
                        'quantity' => $item['order_quantity'],
                        'price' => $product->sale_price * $item['order_quantity'],
                    ]);
                }
            }
        }
        return response()->json('ساخت سفارش موفقیت آمیز بود');
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
        $oldOrderItems = $order->items;
        $ides = [];
        foreach ($request->items as $item) {
            $ides[] = $item['id'];
        }
        return $ides;
        $newOrderItemProductVariations =
            $order->update([
                'status' => '',
                'total_amount' => '',
                'delivery_amount' => '',
                'VAT' => '',
                'coupon_amount' => '',
                'paying_amount' => '',
                'payment_status' => '',
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
        $productVariations = CreateOrderProductVariationsResource::collection(ProductVariation::whereNotIn('id', $request)->latest()->get());
        $selectedProducts = CreateOrderProductVariationsResource::collection(ProductVariation::whereIn('id', $request)->get());
        $products = [
            'products' => $productVariations,
            'selectedProducts' => $selectedProducts
        ];
        return $products;
    }
}
