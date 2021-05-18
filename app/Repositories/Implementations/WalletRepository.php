<?php

namespace App\Repositories;

use App\Models\Wallet;
use App\Repositories\Interfaces\WalletRepositoryInterface;

class WalletRepository implements WalletRepositoryInterface
{
    private $wallet;

    public function __construct()
    {
        $this->wallet = new Wallet();
    }

    public function getWalletByUser(int $userId)
    {
        return $this->wallet->find($userId);
    }
}
