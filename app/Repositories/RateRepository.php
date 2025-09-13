<?php

namespace App\Repositories;

use App\Models\Rate;
use Illuminate\Database\Eloquent\Model;

class RateRepository implements RateRepositoryInterface
{
    protected $rate;

    public function __construct(RateRepository $repo)
    {
        $this->rate = $repo;
    }

    public function all()
    {
        return $this->rate::all();
    }

    public function find(int $id): ?Rate
    {
        return $this->rate::find($id);
    }

    public function createRate(array $data): ?Rate
    {
        return $this->rate::create($data);
    }

    public function updateRate(int $id, array $data): bool
    {
        $rate = $this->rate::find($id);
        if (!$rate) {
            return false;
        }
        return $rate->update($data);
    }

    public function deleteRate(int $id): bool
    {
        $rate = $this->rate::find($id);
        if (!$rate) return false;
        return $rate->delete();
    }
}
