<?php

namespace Domain\User\Repositories;

interface UserRepositoryInterface
{
    public function checkPayerType(array $data);
}
