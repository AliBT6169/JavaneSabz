<?php

namespace App\Repositories;

use App\Models\Rate;
use Illuminate\Database\Eloquent\Model;

interface RateRepositoryInterface
{
    public function all();

    public function find(int $id): ?Rate;

    public function absoluteFind(array $data): ?Rate;

    public function createRate(array $data): ?Rate;

    public function updateRate(int $id, array $data): bool;

    public function deleteRate(int $id): bool;

}
