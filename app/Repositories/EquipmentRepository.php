<?php

namespace App\Repositories;

use App\DTOs\Products\EquipmentWithDTO;
use App\DTOs\Site\CollectionWithPaginationDTO;
use App\Interfaces\EquipmentRepositoryInterface;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Collection;

class EquipmentRepository implements EquipmentRepositoryInterface
{
    protected $model;

    public function __construct(Equipment $model)
    {
        $this->model = $model;
    }

    public function getIcon(int $id): ?string
    {
        return $this->model::find($id)?->icon;
    }

    public function create(EquipmentWithDTO $values): ?EquipmentWithDTO
    {
        $equipment = $this->model::create([
            'name' => $values->name,
            'slug' => $values->slug,
            'description' => $values->description,
            'icon' => $values->iconPath,
        ]);
        return new EquipmentWithDTO($equipment->id, $equipment->name, $equipment->slug, null, $equipment->description, $equipment->icon);
    }

    public function update(int $id, EquipmentWithDTO $equipmentDTO): bool
    {
        return $this->model::whereId($id)->update([
            'name' => $equipmentDTO->name,
            'slug' => $equipmentDTO->slug,
            'description' => $equipmentDTO->description,
            'icon' => $equipmentDTO->iconPath,
        ]);
    }

    public function delete(int $id): bool
    {
        return $this->model::whereId($id)->delete();
    }

    /**
     * @return list<EquipmentWithDTO>
     */
    public function getAll(): array
    {
        $data = $this->model::all();
        $dataList = [];
        foreach ($data as $d) {
            $dataList[] = EquipmentWithDTO::makeWithModel($d);
        }
        return $dataList;
    }

    /**
     * this methode returns a paginated equipments with array of equipment dto & pagination dto
     * @return null|CollectionWithPaginationDTO
     */
    public function getWithPaginate(): ?CollectionWithPaginationDTO
    {
        $data = $this->model::paginate(10);
        if ($data->isEmpty()) return null;
        return EquipmentWithDTO::makeCollectionFromRepository($data);
    }

    public function find(int $id): ?EquipmentWithDTO
    {
        return EquipmentWithDTO::makeWithModel($this->model::find($id));
    }

    public function findByName(string $name): ?CollectionWithPaginationDTO
    {
        $data = $this->model::where('name', 'Like', '%' . $name . '%')->paginate(10);
        if ($data->isEmpty()) return null;
        return EquipmentWithDTO::makeCollectionFromRepository($data);
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
