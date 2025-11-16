<?php

namespace App\Repositories;

use App\Interfaces\EquipmentRepositoryInterface;
use App\Models\Equipment;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class EquipmentRepository implements EquipmentRepositoryInterface
{
    protected $model;

    public function __construct(Equipment $model)
    {
        $this->model = $model;
    }

    public function create(array $values): ?Equipment
    {
        return $this->model::create($values);
    }

    public function update(int $id, array $values): bool
    {
        return $this->model::whereId($id)->update($values);
    }

    public function delete(int $id): bool
    {
        return $this->model::whereId($id)->delete();
    }

    public function getAll(): ?Collection
    {
        return $this->model::all();
    }

    public function find(int $id): ?Equipment
    {
        return $this->model::find($id);
    }

    public function findByName(string $name): ?Equipment
    {
        return $this->model::where('name', $name)->first();
    }

    public function products(int $id): ?Collection
    {
        return $this->model::whereId($id)->get()->products;
    }

    public function attachProduct(int $equipment_id, int $product_id): bool
    {
        return $this->model::whereId($equipment_id)?->attach($product_id);

    }

    public function detachProduct(int $equipment_id, int $product_id): bool
    {
        return $this->model::whereId($equipment_id)?->detach($product_id);
    }

    public function equipmentsHasProduct(): ?Collection
    {
        return $this->model::has('products')->get();
    }

    public function equipmentsDontHasProduct(): ?Collection
    {
        return $this->model::dontHave('products')->get();
    }

    public function attachProducts(int $equipment_id, array $product_ids): bool
    {
        return $this->model::whereId($equipment_id)?->attach($product_ids);
    }

    public function detachProducts(int $equipment_id, array $product_ids): bool
    {
        return $this->model::whereId($equipment_id)?->detach($product_ids);

    }

    public function syncProducts(int $equipment_id, array $product_ids): bool
    {
        return $this->model::whereId($equipment_id)?->sync($product_ids);
    }

    public function checkItsHaveProducts(int $equipment_id): bool
    {
        return $this->model::whereId($equipment_id)?->has('products')->exists();
    }
}
