<?php

namespace App\Repositories\Interfaces;

interface WalletRepositoryInterface
{
    public function getWalletByUser(int $userId);
}
