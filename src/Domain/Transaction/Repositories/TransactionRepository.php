<?php

namespace Domain\Transaction\Repositories;

use Domain\Transaction\Models\Transaction;
use Domain\Transaction\Repositories\TransactionRepositoryInterface;

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
