<?php

namespace App\Repositories;

use App\Models\Notification;

class NotificationRepository implements NotificationRepositoryInterface
{
    protected $model;

    public function __construct(Notification $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model::all();
    }

    public function find(int $id): ?Notification
    {
        return $this::find($id);
    }

    public function create(array $data): Notification
    {
        return $this->model::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $notification = $this->model::find($id);
        if (!$notification)
            return false;
        return $notification->update($data);
    }

    public function delete($id): bool
    {
        $notification = $this->model::find($id);
        if (!$notification)
            return false;
        return $notification->delete();
    }
}
