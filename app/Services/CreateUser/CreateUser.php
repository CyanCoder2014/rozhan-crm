<?php

namespace App\Services\CreateUser;


use App\Repositories\RoleRepository;
use App\Services\CreateUser\ValueObjects\CreateUserValueObject;
use App\User;
use Illuminate\Support\Facades\Hash;

class CreateUser
{
    /**
     * @var CreateUserFactory
     */
    protected $factory;
    /**
     * @var RoleRepository
     */
    protected $roleRepository;

    public function __construct(
        CreateUserFactory $factory,
        RoleRepository $roleRepository
    )
    {
        $this->factory = $factory;
        $this->roleRepository = $roleRepository;
    }

    public function create(CreateUserValueObject $valueObject): User
    {
        $user = $this->factory->getUser();

        $user = $user::create([
            'name'     => $valueObject->getName(),
            'email'    => $valueObject->getEmail(),
            'password' => Hash::make($valueObject->getPassword()),
        ]);

        $defaultRole = $this->roleRepository->getUserRole();

        $user->attachRole($defaultRole);

        return $user;
    }
}
