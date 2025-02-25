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
            'image' => $this->avatar,
            'name' => $this->name,
            'full_name' => $this->full_name,
            'gender' => $this->gender,
            'email' => $this->email,
            'cellphone' => $this->cellphone,
            'created_at' => jalalian::fromDateTime($this->created_at)->format('l, d F Y'),
            'user_address' => $this->address->address ?? null,
            'user_post_code' => $this->address->postcode ?? null,
            'user_buy_cart' => $this->getBuyCartItems($this->buy_carts),
            'user_orders' => $this->getOrder($this->orders),
            'user_transactions' => (object)$this->getTransactions($this->transactions),
            'user_wish_list' => (object)$this->getWishLists($this->wish_lists),
        ];
    }

    public function getBuyCartItems($request)
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

    public function getOrder($request)
    {
        $orders = [];
        foreach ($request as $order) {
            $orders[] = [
                "id" => $order->id,
                "status" => $order->status,
                "items" => $this->getOrderItems($order->orderItems),
                "created_at" => $order->created_at,
            ];
        }
        return $orders;
    }

    public function getOrderItems($request)
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

    public function getTransactions($request)
    {
        $transaction_items = [];
        foreach ($request as $item) {
            $transaction_items[] = [
                "id" => $item->id,
                "price" => $item->order->paying_amount,
                "status" => $item->status,
                "date" => jalalian::fromDateTime($item->created_at)->format('l, d F Y'),
                "products" => $this->getOrderItems($item->order->orderItems),
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
                    "name" => $item->productVariation->product->name,
                    "image" => $item->productVariation->product->primary_image,
                    "price" => $item->productVariation->sale_price,
                    "is_liked" => true,
                ],
            ];
        }
        return $wish_list_items;

    }

}
