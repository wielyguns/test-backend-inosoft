<?php

namespace App\Providers;

use App\Interfaces\MotorRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\MongoDB\MotorRepository;
use App\Repositories\MongoDB\UserRepository;
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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(MotorRepositoryInterface::class, MotorRepository::class);
    }
}
