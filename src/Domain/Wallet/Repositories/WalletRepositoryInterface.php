<?php

namespace Domain\Wallet\Repositories;

use Domain\Wallet\Models\Wallet;

interface WalletRepositoryInterface
{
    public function getWalletByUser(int $userId);
    public function getSufficientWalletAmount(Wallet $payerWallet, $amountTransfer);
    public function increaseAmount(Wallet $payeeWallet, $amount);
    public function decreaseAmount(Wallet $payerWallet, $amount);
}
