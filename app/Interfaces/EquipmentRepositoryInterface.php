<?php

namespace App\Interfaces;

use App\DTOs\Products\EquipmentWithDTO;
use App\DTOs\Site\CollectionWithPaginationDTO;
use App\Models\Equipment;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

interface EquipmentRepositoryInterface
{
    public function create(EquipmentWithDTO $values): ?EquipmentWithDTO;

    public function update(int $id, EquipmentWithDTO $equipmentDTO): bool;

    public function delete(int $id): bool;

    /**
     * @return list<EquipmentWithDTO>
     */
    public function getAll(): array;

    public function find(int $id): ?EquipmentWithDTO;

    public function findByName(string $name): ?CollectionWithPaginationDTO;

    public function products(int $id): ?Collection;

    public function attachProduct(int $equipment_id, int $product_id): bool;
    public function attachProducts(int $equipment_id, array $product_ids): bool;

    public function detachProduct(int $equipment_id, int $product_id): bool;
    public function detachProducts(int $equipment_id, array $product_ids): bool;
    public function syncProducts(int $equipment_id, array $product_ids): bool;

    public function equipmentsHasProduct(): ?Collection;
    public function equipmentsDontHasProduct(): ?Collection;

    public function checkItsHaveProducts(int $equipment_id): bool;
}
