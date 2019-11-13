<?php


namespace App\Services\ChangeUserRole;


use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Role;
use App\Services\ChangeUserRole\Exceptions\SuperAdminRoleException;
use App\Services\ChangeUserRole\Exceptions\RoleNotFoundException;
use App\Services\ChangeUserRole\Exceptions\UserNotFoundException;
use App\User;

class ChangeUserRole
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(
        UserRepository $userRepository,
        RoleRepository $roleRepository
    )
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }

    public function change(int $userId, int $roleId): void
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $role = $this->roleRepository->find($roleId);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        if ($this->isSuperAdmin($user)) {
            throw new SuperAdminRoleException();
        }

        $user->syncRoles([$role]);
    }

    /**
     * @param User $user
     * @return bool
     */
    protected function isSuperAdmin(User $user): bool
    {
        return $user->hasRole('superadministrator');
    }
}
