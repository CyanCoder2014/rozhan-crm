<?php

namespace App\Repositories;


use App\Role;

class RoleRepository
{
    /**
     * @var Role
     */
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function getUserRole(): ?Role
    {
        return $this->model::where('name', 'user')->first();
    }

    public function find(int $id): ?Role
    {
        return $this->model::find($id);
    }

    public function list()
    {
        return $this->model::select('id', 'name', 'display_name', 'description')->get();
    }

    public function rolePermissions(int $id)
    {
        return $this->model::findOrFail($id)->permissions;
    }
}
