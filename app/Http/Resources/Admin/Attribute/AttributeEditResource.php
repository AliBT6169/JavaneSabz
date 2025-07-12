<?php

namespace App\Http\Resources\Admin\Attribute;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeEditResource extends JsonResource
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
            'name' => $this->name,
            'icon' => $this->icon,
            'description' => $this->description ?? '',
            'is_active' => $this->is_active,
            'brands' => $this->getIdes($this->brands),
            'categories' => $this->getIdes($this->categories),
            'products' => $this->getIdes($this->products),
            'product_variations' => $this->getIdes($this->product_variations),
        ];
    }

    public function getIdes($data)
    {
        $ides = [];
        foreach ($data as $item) {
            $ides[] = $item->id;
        }
        return $ides;
    }
}
