<?php

namespace App\DTOs\Products;

use App\DTOs\Site\CollectionWithPaginationDTO;
use App\DTOs\Site\PaginationDTO;
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

    public static function fromEquipmentController(array $validatedData): self
    {
        return new self($validatedData['id'], $validatedData['name'], $validatedData['slug'], $validatedData['icon'], $validatedData['description']);
    }

    /**
     * @param LengthAwarePaginator $equipments
     * @return null|CollectionWithPaginationDTO
     */
    public static function makeCollectionFromRepository(LengthAwarePaginator $equipments): ?CollectionWithPaginationDTO
    {
        $equipmentDTOs = [];
        foreach ($equipments->items() as $equipment) {
            $equipmentDTOs[] = new self($equipment->id, $equipment->name, $equipment->slug, $equipment->icon, $equipment->description);
        }
        return new CollectionWithPaginationDTO($equipmentDTOs, new PaginationDTO($equipments));
    }
}
