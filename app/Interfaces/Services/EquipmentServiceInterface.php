<?php

namespace App\Interfaces\Services;

interface EquipmentServiceInterface
{
    public function syncProducts(int $equipmentId, array $productIds): bool;

    public function setProducts(int $equipmentId, int $productId): bool;

    public function getProducts(int $equipmentId): ?array;

    public function HaveThisProduct(int $equipmentId, int $productId): bool;

    public function findProductsWithName(string $equipmentName): ?array;

    public function emptyEquipments(): array;
}
