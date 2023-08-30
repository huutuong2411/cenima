<?php

namespace App\Providers;

use App\Repositories\RepositoryInterface;
use App\Repositories\UserInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserVerifyInterface;
use App\Repositories\UserVerifyRepository;
use App\Repositories\PasswordResetInterface;
use App\Repositories\PasswordResetRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ExampleInterface::class, ExampleRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(UserVerifyInterface::class, UserVerifyRepository::class);
        $this->app->bind(PasswordResetInterface::class, PasswordResetRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
