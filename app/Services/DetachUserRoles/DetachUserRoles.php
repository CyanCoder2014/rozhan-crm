<?php


namespace App\Services\DetachUserRoles;


use App\Repositories\UserRepository;
use App\Services\DetachUserRoles\Exceptions\UserNotFoundException;

class DetachUserRoles
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function detach(int $userId, array $roles = []): void
    {
        $user = $this->userRepository->find($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->detachRoles($roles);
    }
}
