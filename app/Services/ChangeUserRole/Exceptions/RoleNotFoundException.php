<?php


namespace App\Services\ChangeUserRole\Exceptions;


class RoleNotFoundException extends ChangeUserRoleException
{
    protected $message = 'Role is not found!';
}
