<?php

namespace Domain\Transaction\Services\Interfaces;

interface TransactionServiceInterface
{
    public function makeTransaction($data);
}
