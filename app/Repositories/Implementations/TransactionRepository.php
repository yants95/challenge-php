<?php

namespace App\Repositories\Implementations;

use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    private $transaction;

    public function __construct()
    {
        $this->transaction = new Transaction();
    }

    public function create(array $data)
    {
        return $this->transaction->create($data);
    }
}
