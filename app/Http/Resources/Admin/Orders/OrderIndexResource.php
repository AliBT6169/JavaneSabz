<?php

namespace App\Http\Resources\Admin\Orders;

use App\Http\Resources\Admin\OrderItem\OrderItemIndexResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class OrderIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user' => [
                'id' => $this->user_id,
                'name' => $this->user->name,
            ],
            'items' => OrderItemIndexResource::collection($this->orderItems),
            'code' => $this->code,
            'total_amount' => $this->total_amount,
            'delivery_amount' => $this->delivery_amount,
            'VAT' => $this->VAT,
            'coupon_amount' => $this->coupon_amount,
            'paying_amount' => $this->paying_amount,
            'status' => $this->status,
            'payment_status' => $this->payment_status,
            'created_at' => Jalalian::fromDateTime($this->created_at)->format('l, d F Y H:i:s'),
        ];
    }
}
