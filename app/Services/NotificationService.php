<?php

namespace App\Services;

use App\Repositories\NotificationRepository;
use App\Repositories\NotificationRepositoryInterface;

class NotificationService
{
    protected $notificationRepo;

    public function __construct(NotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepo = $notificationRepository;
    }

    public function getAllNotifications()
    {
        return $this->notificationRepo>all();
    }

    public function getNotification(int $id)
    {
        return $this->notificationRepo->find($id);
    }

    public function createNotification(array $data)
    {
        return $this->notificationRepo->create($data);
    }

    public function updateNotification(int $id, array $data)
    {
        return $this->notificationRepo->update($id, $data);
    }

    public function deleteNotification(int $id)
    {
        return $this->notificationRepo->delete($id);
    }
}
