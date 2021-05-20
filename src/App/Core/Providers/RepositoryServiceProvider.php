<?php

namespace App\Core\Providers;

use App\Core\External\Implementations\MockyAuthorizationService;
use App\Core\External\Interfaces\AuthorizationServiceInterface;

use Domain\Transaction\Repositories\TransactionRepository;
use Domain\Transaction\Repositories\TransactionRepositoryInterface;

use Domain\Wallet\Repositories\WalletRepositoryInterface;
use Domain\Wallet\Repositories\WalletRepository;

use Domain\User\Repositories\UserRepositoryInterface;
use Domain\User\Repositories\UserRepository;

use Domain\Transaction\Services\Interfaces\TransactionServiceInterface;
use Domain\Transaction\Services\Implementations\TransactionService;

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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
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
