<?php

namespace App\Repositories;


use App\Permission;

class PermissionRepository
{
    public const PAGINATION_LIMIT = 10;
    /**
     * @var Permission
     */
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function searchDisplayName(string $query)
    {
        return $this->model::select('id', 'name', 'display_name', 'description')
            ->where('display_name', 'LIKE', "%$query%")
            ->paginate(self::PAGINATION_LIMIT);
    }

    public function findIds(array $permissions)
    {
        return $this->model::findMany($permissions);
    }
}
