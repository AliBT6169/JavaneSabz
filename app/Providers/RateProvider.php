<?php

namespace App\Providers;

use App\Repositories\RateRepository;
use App\Repositories\RateRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RateProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RateRepositoryInterface::class, RateRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
