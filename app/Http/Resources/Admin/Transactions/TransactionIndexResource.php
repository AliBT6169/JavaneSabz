<?php

namespace App\Http\Resources\Admin\Transactions;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'order' => $this->order,
            'ref_id' => $this->ref_id ?? '',
            'token' => $this->token ?? '',
            'gateway_name' => $this->gateway_name ?? '',
            'status' => $this->status ?? '',
        ];
    }
}
