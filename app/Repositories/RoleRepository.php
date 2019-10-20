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

    public function getUserRole(): Role
    {
//        return $this->model::where('name', 'user')->first();
        return $this->model->where('name', 'user')->first();
    }
}
