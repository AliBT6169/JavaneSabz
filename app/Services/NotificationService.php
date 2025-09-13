<?php

namespace App\Services;

use App\Repositories\NotificationRepository;
use App\Repositories\NotificationRepositoryInterface;
use Illuminate\Support\Facades\Log;
use function Webmozart\Assert\Tests\StaticAnalysis\integer;

class NotificationService
{
    protected $notificationRepo;

    public function __construct(NotificationRepositoryInterface $notificationRepository)
    {
        $this->notificationRepo = $notificationRepository;
    }

    public function getAllNotifications()
    {
        return $this->notificationRepo->all();
    }

    public function getWithPagination(int $perPage = 10)
    {
        return $this->notificationRepo->getWithPaginate($perPage);
    }

    public function isSeen(int $id)
    {
        return $this->notificationRepo->seen($id);
    }

    public function getSeen(array $ides)
    {
        if (is_array($ides)) {
            foreach ($ides as $id) {
                $this->notificationRepo->getSeen($id);
            }
            return $this->notificationRepo->getUnseensCount();
        }
        return false;
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

    public function getUnseensCount()
    {
        return $this->notificationRepo->getUnseensCount();
    }
}
