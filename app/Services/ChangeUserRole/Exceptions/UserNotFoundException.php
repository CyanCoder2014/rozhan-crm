<?php


namespace App\Services\ChangeUserRole\Exceptions;


class UserNotFoundException extends ChangeUserRoleException
{
    protected $message = 'User is not found!';
}
