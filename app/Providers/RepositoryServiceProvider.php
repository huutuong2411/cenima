<?php

namespace App\Providers;

use App\Repositories\CategoriesInterface;
use App\Repositories\CategoriesRepository;
use App\Repositories\CitiesInterface;
use App\Repositories\CitiesRepository;
use App\Repositories\ColumnInterface;
use App\Repositories\ColumnRepository;
use App\Repositories\MovieInterface;
use App\Repositories\MovieRepository;
use App\Repositories\PasswordResetInterface;
use App\Repositories\PasswordResetRepository;
use App\Repositories\RoomsInterface;
use App\Repositories\RoomsRepository;
use App\Repositories\RowInterface;
use App\Repositories\RowRepository;
use App\Repositories\SeatsInterface;
use App\Repositories\SeatsRepository;
use App\Repositories\ShowtimeInterface;
use App\Repositories\ShowtimeRepository;
use App\Repositories\TheatersInterface;
use App\Repositories\TheatersRepository;
use App\Repositories\UserInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserVerifyInterface;
use App\Repositories\UserVerifyRepository;
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
        $this->app->bind(MovieInterface::class, MovieRepository::class);
        $this->app->bind(CategoriesInterface::class, CategoriesRepository::class);
        $this->app->bind(TheatersInterface::class, TheatersRepository::class);
        $this->app->bind(RoomsInterface::class, RoomsRepository::class);
        $this->app->bind(RowInterface::class, RowRepository::class);
        $this->app->bind(ColumnInterface::class, ColumnRepository::class);
        $this->app->bind(SeatsInterface::class, SeatsRepository::class);
        $this->app->bind(CitiesInterface::class, CitiesRepository::class);
        $this->app->bind(ShowtimeInterface::class, ShowtimeRepository::class);
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
