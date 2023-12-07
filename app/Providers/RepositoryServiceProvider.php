<?php

namespace App\Providers;

use App\Repositories\Medicine\MedicineRepositoryContract;
use App\Repositories\Medicine\MedicineRepositoryEloquent;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Auth\AuthRepositoryEloquent;
use App\Repositories\Auth\AuthRepositoryContract;

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
        $this->app->bind(AuthRepositoryContract::class, AuthRepositoryEloquent::class);
        $this->app->bind(MedicineRepositoryContract::class, MedicineRepositoryEloquent::class);
    }
}
