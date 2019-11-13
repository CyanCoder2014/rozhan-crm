<?php


namespace App\Services\AttachPermissionsToRole\Exceptions;


class RoleNotFoundException extends AttachPermissionsToRoleException
{
    protected $message = 'Role is not found!';
}
