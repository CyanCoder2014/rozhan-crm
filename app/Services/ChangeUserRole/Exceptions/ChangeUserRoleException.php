<?php


namespace App\Services\ChangeUserRole\Exceptions;


use Illuminate\Http\Response;

class ChangeUserRoleException extends \Exception
{
    protected $code = Response::HTTP_BAD_REQUEST;
}
