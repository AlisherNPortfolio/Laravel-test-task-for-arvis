<?php

namespace App\Providers;

use App\Repositories\Base\BaseRepository;
use App\Repositories\Contracts\ExpenditureRepositoryInterface;
use App\Repositories\Contracts\MeasureRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\ExpenditureRepository;
use App\Repositories\MeasureRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, BaseRepository::class);
        $this->app->bind(MeasureRepositoryInterface::class, MeasureRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ExpenditureRepositoryInterface::class, ExpenditureRepository::class);
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
