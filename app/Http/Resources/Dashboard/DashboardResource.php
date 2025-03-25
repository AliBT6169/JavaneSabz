<?php

namespace App\Http\Resources\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class DashboardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'is_admin' => $this->is_admin,
            'image' => $this->gallery->media??'images/default/default.jpg',
            'name' => $this->name,
            'full_name' => $this->full_name??'',
            'gender' => $this->gender,
            'email' => $this->email,
            'cellphone' => $this->cellphone,
            'created_at' => jalalian::fromDateTime($this->created_at)->format('l, d F Y'),
            'user_address' => $this->address->address ?? '',
            'user_post_code' => $this->address->postcode ?? '',
            'user_buy_cart' => $this->getBuyCartItems($this->buy_carts),
            'user_orders' => $this->getOrder($this->orders),
            'user_transactions' => (object)$this->getTransactions($this->transactions),
            'user_wish_list' => (object)$this->getWishLists($this->wish_lists),
        ];
    }

    public static function getBuyCartItems($request)
    {
        $BuyCartItems = [];
        foreach ($request as $buy_cart_item) {
            $BuyCartItems[] = [
                "id" => $buy_cart_item->id,
                "name" => $buy_cart_item->product_variation->product->name,
                "image" => $buy_cart_item->product_variation->product->primary_image,
                "description" => $buy_cart_item->product_variation->product->description,
                "size" => $buy_cart_item->product_variation->value,
                "quantity" => $buy_cart_item->quantity,
                "price" => $buy_cart_item->product_variation->sale_price,
            ];
        }
        return $BuyCartItems;
    }

    public static function getOrder($request)
    {
        $orders = [];
        foreach ($request as $order) {
            $orders[] = [
                "id" => $order->id,
                "status" => $order->status,
                "price" => $order->paying_amount,
                "items" => DashboardResource::getOrderItems($order->orderItems),
                "created_at" => $order->created_at,
            ];
        }
        return $orders;
    }

    public static function getOrderItems($request)
    {
        $order_items = [];
        foreach ($request as $item) {
            $order_items[] = [
                "id" => $item->id,
                "name" => $item->productVariation->product->name,
                "image" => $item->productVariation->product->primary_image,
                "quantity" => $item->quantity,
                "created_at" => $item->created_at,
                "price" => $item->productVariation->sale_price,
            ];
        }
        return $order_items;

    }

    public static function getTransactions($request)
    {
        $transaction_items = [];
        foreach ($request as $item) {
            $transaction_items[] = [
                "id" => $item->id,
                "price" => $item->order->paying_amount,
                "status" => $item->status,
                "date" => jalalian::fromDateTime($item->created_at)->format('l, d F Y'),
                "products" => DashboardResource::getOrderItems($item->order->orderItems),
            ];
        }
        return $transaction_items;

    }

    public static function getWishLists($request)
    {
        $wish_list_items = [];
        foreach ($request as $item) {
            $wish_list_items [] = [
                "product" => [
                    "id" => $item->productVariation->id,
                    "product_id" => $item->productVariation->product_id,
                    "name" => $item->productVariation->product->name,
                    "image" => $item->productVariation->product->primary_image,
                    "price" => $item->productVariation->sale_price,
                    "quantity" => $item->productVariation->quantity,
                    "is_liked" => true,
                ],
            ];
        }
        return $wish_list_items;

    }

}
