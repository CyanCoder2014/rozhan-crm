<?php

namespace App\Services\UserRoleList;


use App\Repositories\UserRepository;
use App\Services\UserRoleList\Exceptions\UserNotFoundException;
use Illuminate\Support\Arr;

class UserRoleList
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function get(int $userId): array
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $roles = $user->roles()->get(['id', 'name', 'display_name', 'description'])->toArray();

        return array_map(function ($role) {
            Arr::forget($role, ['pivot']);

            return $role;
        }, $roles);
    }
}
