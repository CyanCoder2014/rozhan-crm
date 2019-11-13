<?php


namespace App\Services\ChangeUserRole\Exceptions;


class SuperAdminRoleException extends ChangeUserRoleException
{
    protected $message = 'User has super admin role and it can not be changed!';
}
