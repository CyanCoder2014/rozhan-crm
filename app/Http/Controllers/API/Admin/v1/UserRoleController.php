<?php

namespace App\Http\Controllers\API\Admin\v1;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRole\ListRequest;
use App\Services\UserRoleList\Exceptions\UserNotFoundException;
use App\Services\UserRoleList\UserRoleList;

class UserRoleController extends Controller
{
    public function list(ListRequest $request, UserRoleList $userRoleList)
    {
        try {
            $result = $userRoleList->get($request->get('userId'));
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
