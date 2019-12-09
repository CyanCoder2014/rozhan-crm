<?php

namespace App\Http\Controllers\API\Client\v1;


use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Controllers\workCalendarController;
use App\Http\Requests\Client\ContactUpdateRequest;
use App\Http\Requests\Client\User\RegisterRequest;
use App\Http\Requests\Client\User\ResetPassword;
use App\Http\Requests\workCalendarRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\CreateUser\CreateUser;
use App\Services\CreateUser\ValueObjects\CreateUserValueObject;
use App\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserWorkCalendarController extends workCalendarController
{
    public function index(workCalendarRequest $request)
    {
        $person = \auth()->user()->person;
        if (! $person)
            return $this->response(null,'شما جزو پرسنل نیستید',400);
        $request->request->set('person_ids' , [
            $person->id
        ]);
        return parent::index($request); // TODO: Change the autogenerated stub
    }
}
