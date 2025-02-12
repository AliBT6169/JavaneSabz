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
        $buy_cart = [];
        foreach ($this->buy_carts as $buy_cart_item) {
            $buy_cart[]= (object)[
                "product_size"=>$buy_cart_item->product_variation->value,
                "product_quantity"=> $buy_cart_item->product_variation->quantity,
                "product_price" => $buy_cart_item->product_variation->sale_price,
            ];
        }
        return [
            'id' => $this->id,
            'is_admin' => $this->is_admin,
            'name' => $this->name,
            'full_name' => $this->full_name,
            'gender' => $this->gender,
            'email' => $this->email,
            'cellphone' => $this->cellphone,
            'created_at' => jalalian::fromDateTime($this->created_at)->format('l, d F Y'),
            'user_address' => $this->address->address ?? null,
            'user_post_code' => $this->address->postcode ?? null,
            'user_buy_cart' => $buy_cart,
        ];
    }
}
