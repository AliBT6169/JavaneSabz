<?php

namespace App\DTOs\Products;

class EquipmentDTO
{
    protected $id;
    protected $name;
    protected $slug;
    protected $icon;
    protected $description;
    protected $createdAt;
    protected $updatedAt;

    public function __construct(int $id, string $name, string $slug, string $createdAt, string $updatedAt, ?string $icon, ?string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->icon = $icon ?? null;
        $this->description = $description ?? null;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function get(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'icon' => $this->icon,
            'description' => $this->description,
            'createdAt' => $this->createdAt,
            'updatedAt' => $this->updatedAt,
        ];
    }
}
