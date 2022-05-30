<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\CRUDInterface;
use App\Repositories\CustomerRepository;
use App\Repositories\PenyediaJasaRepository;
use App\Repositories\PaketRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CRUDInterface::class, CustomerRepository::class);
        $this->app->bind(CRUDInterface::class, PenyediaJasaRepository::class);
        $this->app->bind(CRUDInterface::class, PaketRepository::class);
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
