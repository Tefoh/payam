<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Qasedak\Repositories\MessageRepository;
use App\Qasedak\Repositories\Interfaces\MessageRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            MessageRepositoryInterface::class,
            MessageRepository::class
        );
    }
}
