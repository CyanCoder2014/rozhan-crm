<?php

namespace App\Http\Controllers\API\SuperAdmin\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Admin\AddRequest;
use App\Repositories\AdminRepository;
use App\Services\AddAdmin\AddAdminService;
use App\Services\AddAdmin\ValueObjects\AddAdminValueObject;

class AdminController extends Controller
{
    public function add(AddRequest $request, AddAdminService $addAdmin)
    {
        $valueObject = new AddAdminValueObject();

        $valueObject->setFullName($request->get('full_name'))
                    ->setEmail($request->get('email'))
                    ->setPassword($request->get('password'));

        $addAdmin->perform($valueObject);

        return response()->json([
            'status'  => true,
            'message' => 'Admin is added successfully!'
        ]);
    }

    public function list(AdminRepository $adminRepository)
    {
        return response()->json([
            'status' => true,
            'result' => $adminRepository->list()
        ]);
    }
}
