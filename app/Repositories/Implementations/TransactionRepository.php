<?php

namespace App\Repositories\Implementations;

use App\Models\Transaction;
use App\Repositories\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    private $transactionModel;

    public function __construct()
    {
        $this->transactionModel = new Transaction();
    }

    public function create(array $data)
    {
        return $this->transactionModel->create($data);
    }
}
