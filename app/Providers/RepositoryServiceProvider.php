<?php

namespace App\Providers;

use App\External\Implementations\MockyAuthorizationService;
use App\External\Interfaces\AuthorizationServiceInterface;

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
        $this->app->bind(AuthorizationServiceInterface::class, MockyAuthorizationService::class);
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
