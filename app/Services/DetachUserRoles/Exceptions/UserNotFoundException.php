<?php


namespace App\Services\DetachUserRoles\Exceptions;


use Illuminate\Http\Response;

class UserNotFoundException extends \Exception
{
    protected $code = Response::HTTP_BAD_REQUEST;

    protected $message = 'User is not found!';
}
