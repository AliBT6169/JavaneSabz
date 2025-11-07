<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface smsRepositoryInterface
{
    public function store(string $message): bool;

    public function index(): ?Collection;

}
