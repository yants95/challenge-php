<?php

namespace Domain\User\Repositories;

use Domain\User\Repositories\UserRepositoryInterface;
use Domain\User\Models\User;
use Domain\User\Enum\UserType;

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
