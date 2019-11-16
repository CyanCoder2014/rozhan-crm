<?php

namespace App\Services\AttachPermissionsToRole;


use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Services\AttachPermissionsToRole\Exceptions\PermissionsNotFoundException;
use App\Services\AttachPermissionsToRole\Exceptions\RoleNotFoundException;

class AttachPermissionsToRole
{
    /**
     * @var RoleRepository
     */
    protected $roleRepository;
    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    public function __construct(
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository
    )
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function attach(int $roleId, array $permissions): void
    {
        $role = $this->roleRepository->find($roleId);

        if (!$role) {
            throw new RoleNotFoundException();
        }

        $permissions = $this->permissionRepository->findIds($permissions);

        if ($permissions->count() === 0) {
            throw new PermissionsNotFoundException();
        }

        $role->syncPermissions($permissions);
    }
}
