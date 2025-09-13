<?php

namespace App\Services;

use App\Models\Rate;
use App\Repositories\RateRepository;

class RateService
{
    protected $rateRepository;

    public function __construct(RateRepository $rateRepository)
    {
        $this->rateRepository = $rateRepository;
    }

    public function all()
    {
        return $this->rateRepository->all();
    }

    public function create(array $data): Rate
    {
        return $this->rateRepository->createRate($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->rateRepository->updateRate($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->rateRepository->deleteRate($id);
    }
}
