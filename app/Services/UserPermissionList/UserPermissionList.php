<?php

namespace App\Services\UserPermissionList;


use App\Repositories\UserRepository;
use App\Services\UserPermissionList\Exceptions\UserNotFoundException;
use Illuminate\Support\Arr;

class UserPermissionList
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

        $permissions = $user->allPermissions()->toArray();

        return array_map(function ($permission) {
            Arr::forget($permission, ['pivot', 'created_at', 'updated_at']);

            return $permission;
        }, $permissions);
    }
}
