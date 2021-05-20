<?php

namespace Domain\Transaction\Repositories;

interface TransactionRepositoryInterface
{
    public function create(array $data);
}
