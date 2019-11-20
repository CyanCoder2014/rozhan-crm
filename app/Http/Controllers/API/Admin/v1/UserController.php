<?php

namespace App\Http\Controllers\API\Admin\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\CreateRequest;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\CreateUser\CreateUser;
use App\Services\CreateUser\ValueObjects\CreateUserValueObject;

class UserController extends Controller
{
    protected $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }



    public function list()
    {
        $users = $this->userRepository->list();

        return response()->json([
            'status' => true,
            'data'   => $users
        ]);
    }



    public function create(CreateRequest $request, CreateUser $createUser)
    {
        $data = $request->all();

        $valueObject = new CreateUserValueObject();
        $valueObject->setName($data['name'])
            ->setEmail($data['email'])
            ->setPassword($data['password']);

        $user = $createUser->create($valueObject);

        return response()->json([
            'status'  => true,
            'result'  => $user,
            'message' => 'User is created successfully!'
        ]);
    }
}
