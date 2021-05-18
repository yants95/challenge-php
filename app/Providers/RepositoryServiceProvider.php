<?php

namespace App\Providers;

use App\Repositories\Implementations\TransactionRepository;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

use App\Repositories\Interfaces\WalletRepositoryInterface;
use App\Repositories\WalletRepository;

use App\Services\Implementations\TransactionService;
use App\Services\Interfaces\TransactionServiceInterface;

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
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(WalletRepositoryInterface::class, WalletRepository::class);
        $this->app->bind(TransactionServiceInterface::class, TransactionService::class);
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
