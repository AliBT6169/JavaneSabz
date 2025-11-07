<?php

namespace App\Services;


use App\Repositories\SMSRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;

class SMSService
{
    protected $repo;
    protected $pannelNumber;
    protected $pannelUserName;
    protected $pannelPass;

    public function __construct(SMSRepository $repo)
    {
        $this->repo = $repo;
        $this->pannelNumber = '30008810668877';
        $this->pannelUserName = "19114303905";
        $this->pannelPass = "#E2@Q";
    }

    public function store(array $mobiles, string $message): bool
    {
        $finalMessage = $message . PHP_EOL . 'لغو=11';
        foreach ($mobiles as $mobile) {
            $response = Http::post('https://rest.payamak-panel.com/api/SendSMS/SendSMS', [
                'username' => $this->pannelUserName,
                'password' => $this->pannelPass,
                'to' => (string)$mobile,
                'from' => $this->pannelNumber,
                'text' => $finalMessage,
            ]);
        }
        return $this->repo->store($finalMessage);
    }

    public function index(): Collection
    {
        return $this->repo->index();
    }

}
