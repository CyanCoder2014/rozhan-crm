<?php

namespace App\Repositories;


use App\User;

class UserRepository
{
    /**
     * @var User
     */
    protected $model;

    // Constructor to bind model to repo
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function existsWithEmail(string $email): bool
    {
        return $this->model::where('email', $email)->exists();
    }

    public function find(int $id): ?User
    {
        return $this->model::find($id);
    }
}
