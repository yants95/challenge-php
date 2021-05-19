<?php

namespace App\Repositories\Implementations;

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

    public function getSufficientWalletAmount(Wallet $payerWallet, $amountTransfer)
    {
        return $payerWallet->amount >= $amountTransfer;
    }

    public function increaseAmount(Wallet $wallet, $amount)
    {
        $wallet->amount += $amount;
        return $wallet->save();
    }

    public function decreaseAmount(Wallet $wallet, $amount)
    {
        $wallet->amount -= $amount;
        return $wallet->save();
    }
}
