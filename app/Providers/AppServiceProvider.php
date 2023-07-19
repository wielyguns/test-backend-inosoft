<?php

namespace App\Providers;

use App\Interfaces\MobilRepositoryInterface;
use App\Interfaces\MotorRepositoryInterface;
use App\Services\KendaraanService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Model::preventLazyLoading(!config('app.env') == 'production');
    }
}
