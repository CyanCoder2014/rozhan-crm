<?php


namespace App\Services\AttachPermissionsToRole\Exceptions;


class PermissionsNotFoundException extends AttachPermissionsToRoleException
{
    protected $message = 'Permissions is not found!';
}
