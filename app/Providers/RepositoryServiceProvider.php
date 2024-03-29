<?php

namespace App\Providers;

use App\Qasedak\Message\Repositories\Interfaces\ManageRepositoryInterface;
use App\Qasedak\Message\Repositories\ManageRepository;
use App\Qasedak\User\Repositories\Interfaces\UserRepositoryInterface;
use App\Qasedak\User\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Qasedak\Api\Repositories\ApiRepository;
use App\Qasedak\Api\Repositories\Interfaces\ApiRepositoryInterface;
use App\Qasedak\File\Repositories\FileRepository;
use App\Qasedak\File\Repositories\Interfaces\FileRepositoryInterface;
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

        $this->app->bind(
            ApiRepositoryInterface::class,
            ApiRepository::class
        );

        $this->app->bind(
            FileRepositoryInterface::class,
            FileRepository::class
        );

        $this->app->bind(
            ManageRepositoryInterface::class,
            ManageRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
    }
}
