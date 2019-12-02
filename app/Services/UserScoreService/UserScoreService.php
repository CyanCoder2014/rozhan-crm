<?php


namespace App\Services\UserScoreService;


use App\Services\UserScoreService\UserScoreRepository\UserScoreRepository;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserScoreService
{
    protected $repository;
    public function __construct(UserScoreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function addScore(int $amount,$model,User $user,$title)
    {
        $this->repository->add($amount,$model->getMorphClass(),$model->id,$user->id,$title,auth()->id());

    }

    public function getScore(User $user)
    {
        return $this->repository->getUserScore($user->id);

    }

}