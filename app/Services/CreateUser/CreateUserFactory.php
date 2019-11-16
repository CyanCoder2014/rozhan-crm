<?php

namespace App\Services\CreateUser;


use App\User;

class CreateUserFactory
{
    public function getUser(): User
    {
        return new User();
    }
}
