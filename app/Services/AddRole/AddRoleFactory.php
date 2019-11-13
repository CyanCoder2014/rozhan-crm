<?php

namespace App\Services\AddRole;


use App\Role;

class AddRoleFactory
{
    public function getRole(): Role
    {
        return new Role();
    }
}
