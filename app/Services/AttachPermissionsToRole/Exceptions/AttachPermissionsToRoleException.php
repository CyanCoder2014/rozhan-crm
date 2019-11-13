<?php


namespace App\Services\AttachPermissionsToRole\Exceptions;


use Illuminate\Http\Response;

class AttachPermissionsToRoleException extends \Exception
{
    protected $code = Response::HTTP_BAD_REQUEST;
}
