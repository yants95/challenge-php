<?php

namespace App\Repositories\Implementations;

use App\Enum\UserType;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function checkPayerType($userId)
    {
        $person = $this->user->find($userId);

        return $person->user_type === UserType::COMMON_PERSON;
    }
}
