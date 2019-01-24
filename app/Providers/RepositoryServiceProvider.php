<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Qasedak\Message\Repositories\MessageRepository;
use App\Qasedak\Message\Repositories\Interfaces\MessageRepositoryInterface;
use App\Qasedak\Ajax\Repositories\AjaxRepository;
use App\Qasedak\Ajax\Repositories\Interfaces\AjaxRepositoryInterface;

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

        $this->app->bind(
            AjaxRepositoryInterface::class,
            AjaxRepository::class
        );
    }
}
