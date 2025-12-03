<?php

namespace App\DTOs\Products;

use App\DTOs\Site\CollectionWithPaginationDTO;
use App\DTOs\Site\PaginationDTO;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class EquipmentWithDTO
{
    public PaginationDTO $pagination;

    public function __construct(public ?int          $id = null,
                                public string        $name,
                                public string        $slug,
                                public ?UploadedFile $icon = null,
                                public ?string       $description = null,
                                public ?string       $iconPath = null,
    )
    {
        //
    }


    /**
     * @param array{
     *     id: ?int|null,
     *     name: string,
     *     slug: ?string|null,
     *     icon: ?UploadedFile|string|null,
     *     description: ?string|null,
     *     iconPath: ?string|null
     * } $validatedData
     * @return self
     */
    public static function fromEquipmentController(array $validatedData): self
    {
//        right there . transform icon data
        return new self($validatedData['id'] ?? null, $validatedData['name'], $validatedData['slug'] ?? $validatedData['name'], $validatedData['icon'] ?? null, $validatedData['description'] ?? null, $validatedData['iconPath'] ?? null);
    }

    /**
     * @param LengthAwarePaginator $equipments
     * @return null|CollectionWithPaginationDTO
     */
    public static function makeCollectionFromRepository(LengthAwarePaginator $equipments): ?CollectionWithPaginationDTO
    {
        $equipmentDTOs = [];
        foreach ($equipments->items() as $equipment) {
            $equipmentDTOs[] = new self(
                id: $equipment->id,
                name: $equipment->name,
                slug: $equipment->slug,
                icon: null,
                description: $equipment->description,
                iconPath: $equipment->icon);
        }
        return new CollectionWithPaginationDTO($equipmentDTOs, new PaginationDTO($equipments));
    }

    public static function makeWithModel(Equipment $model): EquipmentWithDTO
    {
        return new EquipmentWithDTO(
            id: $model->id,
            name: $model->name,
            slug: $model->slug,
            icon: null,
            description: $model->description,
            iconPath: $model->icon,
        );
    }
}
