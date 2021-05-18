<?php

namespace App\Repositories\Interfaces;

use App\Models\Wallet;

interface WalletRepositoryInterface
{
    public function getWalletByUser(int $userId);
    public function getSufficientWalletAmount($amountTransfer);
    public function increaseAmount(Wallet $payeeWallet, $amount);
    public function decreaseAmount(Wallet $payerWallet, $amount);
}
