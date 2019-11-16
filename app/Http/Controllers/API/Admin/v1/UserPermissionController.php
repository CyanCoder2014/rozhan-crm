<?php

namespace App\Http\Controllers\API\Admin\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserPermission\ListRequest;
use App\Services\UserPermissionList\Exceptions\UserNotFoundException;
use App\Services\UserPermissionList\UserPermissionList;

class UserPermissionController extends Controller
{
    public function list(ListRequest $request, UserPermissionList $userPermissionList)
    {
        try {
            $result = $userPermissionList->get($request->get('userId'));
        } catch (UserNotFoundException $e) {
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
            ], $e->getCode());
        }

        return response()->json([
            'status' => true,
            'data'   => $result
        ]);
    }
}
