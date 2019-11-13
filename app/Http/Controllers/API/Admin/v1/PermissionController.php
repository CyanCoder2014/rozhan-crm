<?php

namespace App\Http\Controllers\API\Admin\v1;


use App\Http\Controllers\Controller;
use App\Repositories\PermissionRepository;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * @var PermissionRepository
     */
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function list(Request $request)
    {
        $query = $request->get('q') ?? '';

        return $this->permissionRepository->searchDisplayName($query);
    }
}
