<?php

namespace App\Http\Resources\Admin\Transactions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Morilog\Jalali\Jalalian;

class TransactionIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->user->name,
            'order' => [
                'items' => TransactionOrderItemsIndexResource::collection($this->order->orderItems),
                'total_amount' => $this->order->total_amount,
                'delivery_amount' => $this->order->delivery_amount,
                'VAT' => $this->order->VAT,
                'coupon_amount' => $this->order->coupon_amount,
                'paying_amount' => $this->order->paying_amount,
                'payment_status' => $this->order->payment_status,
            ],
            'ref_id' => $this->ref_id ?? '123456789',
            'token' => $this->token ?? '',
            'gateway_name' => $this->gateway_name ?? '',
            'status' => $this->status ?? '',
            'created_at' => Jalalian::fromDateTime($this->created_at)->format('l, d F Y H:i:s'),
        ];
    }
}
