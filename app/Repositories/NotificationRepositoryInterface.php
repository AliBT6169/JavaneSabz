<?php

namespace App\Repositories;

use App\Models\Notification;

interface NotificationRepositoryInterface
{
    public function all();

    public function find(int $id);

    public function create(array $data): Notification;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;
}
