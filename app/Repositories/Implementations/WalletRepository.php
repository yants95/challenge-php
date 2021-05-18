<?php

namespace App\Repositories;

use App\Models\Wallet;
use App\Repositories\Interfaces\WalletRepositoryInterface;
class WalletRepository implements WalletRepositoryInterface
{
    private $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function getWalletByUser(int $userId)
    {
        return $this->wallet->find($userId);
    }

    public function getSufficientWalletAmount($amountTransfer)
    {
        return $this->wallet->amount >= $amountTransfer;
    }

    public function increaseAmount(Wallet $wallet, $amount)
    {
        return $wallet->amount += $amount;
    }

    public function decreaseAmount(Wallet $wallet, $amount)
    {
        return $wallet->amount -= $amount;
    }
}
