<?php

namespace App\Repositories;

use App\Interfaces\smsRepositoryInterface;
use App\Models\SMS;
use Illuminate\Database\Eloquent\Collection;

class SMSRepository implements smsRepositoryInterface
{
    protected $model;

    public function __construct(SMS $sms)
    {
        $this->model = $sms;
    }

    public function store(string $message): bool
    {
        $sms = $this->model::create([
            'message' => $message,
        ]);
        if ($sms)
            return true;
        return false;
    }

    public function index(): ?Collection
    {
        return $this->model::all();
    }
}
