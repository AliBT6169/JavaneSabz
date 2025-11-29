<?php

namespace App\DTOs\Site;

/**
 * @template T
 */
class CollectionWithPaginationDTO
{
    /**
     * @var T[]
     */
    public array $items;
    public PaginationDTO $paginationDTO;

    /**
     * @param T[] $items
     */
    public function __construct(array $items, PaginationDTO $paginationDTO)
    {
        $this->items = $items;
        $this->paginationDTO = $paginationDTO;
    }
}
