<?php

namespace App\Http\Controllers\API\Admin\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Role\AddRequest;
use App\Http\Requests\Admin\Role\AttachPermissionsRequest;
use App\Http\Requests\Admin\Role\ChangeUserRoleRequest;
use App\Http\Requests\Admin\Role\DetachUserRoleRequest;
use App\Role;
use App\Services\AddRole\AddRole;
use App\Services\AddRole\ValueObjects\AddRoleValueObject;
use App\Services\AttachPermissionsToRole\AttachPermissionsToRole;
use App\Services\AttachPermissionsToRole\Exceptions\AttachPermissionsToRoleException;
use App\Services\AttachPermissionsToRole\Exceptions\PermissionsNotFoundException;
use App\Services\AttachPermissionsToRole\Exceptions\RoleNotFoundException;
use App\Services\ChangeUserRole\ChangeUserRole;
use App\Services\ChangeUserRole\Exceptions\ChangeUserRoleException;
use App\Services\DetachUserRoles\DetachUserRoles;
use App\Services\DetachUserRoles\Exceptions\UserNotFoundException;

class RoleController extends Controller
{
    public function add(AddRequest $request, AddRole $addRole)
    {
        $valueObject = new AddRoleValueObject();

        $valueObject->setName($request->get('name'))
            ->setDisplayName($request->get('displayName'))
            ->setDescription($request->get('description'));

        $addRole->perform($valueObject);

        return response()->json([
            'status'  => true,
            'message' => 'Role is added successfully!'
        ]);
    }

    public function attachPermissions(
        AttachPermissionsRequest $request,
        AttachPermissionsToRole $attachPermissionsToRole
    )
    {
        try {
            $attachPermissionsToRole->attach($request->get('id'), $request->get('permissions'));
        } catch (AttachPermissionsToRoleException $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], $e->getCode());
        }

        return response()->json([
            'status'  => true,
            'message' => 'Permissions is attached to role successfully!'
        ]);
    }

    public function changeUserRole(
        ChangeUserRoleRequest $request,
        ChangeUserRole $changeUserRole
    )
    {
        try {
            $changeUserRole->change($request->get('userId'), $request->get('userId'));
        } catch (ChangeUserRoleException $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], $e->getCode());
        }

        return response()->json([
            'status'  => true,
            'message' => 'User role is changed successfully!'
        ]);
    }

    public function detachUserRoles(
        DetachUserRoleRequest $request,
        DetachUserRoles $detachUserRoles
    )
    {
        $roles = $request->get('roles') ?? [];

        try {
            $detachUserRoles->detach($request->get('userId'), $roles);
        } catch (UserNotFoundException $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], $e->getCode());
        }

        return response()->json([
            'status'  => true,
            'message' => 'User role is detached successfully!'
        ]);
    }
}
