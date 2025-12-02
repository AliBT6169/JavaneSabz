<?php

namespace App\DTOs\Site;

use Illuminate\Pagination\LengthAwarePaginator;

class PaginationDTO
{
    public string $firstPageLink;
    public string $lastPageLink;
    public string|null $nextPageLink;
    public string|null $previousPageLink;
    public int $totalCount;
    public int $perPage;
    public int $currentPage;
    public int $totalPage;

    public function __construct(LengthAwarePaginator $pagination)
    {
        $this->firstPageLink = $pagination->url(1);
        $this->lastPageLink = $pagination->url($pagination->lastPage());
        $this->nextPageLink = $pagination->nextPageUrl();
        $this->previousPageLink = $pagination->previousPageUrl();
        $this->totalCount = $pagination->total();
        $this->perPage = $pagination->perPage();
        $this->currentPage = $pagination->currentPage();
        $this->totalPage = $pagination->lastPage();
    }
}
