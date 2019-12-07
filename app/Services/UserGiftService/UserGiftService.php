<?php


namespace App\Services\UserGiftService;


use App\ScoreGifts;
use App\Services\UserGiftService\UserGiftRepository\UserGiftRepository;
use App\Services\UserScoreService\UserScoreService;
use App\User;
use Illuminate\Validation\ValidationException;

class UserGiftService
{
    protected $userScoreService;
    protected $repository;
    public function __construct(UserScoreService $userScoreService,UserGiftRepository $repository)
    {
        $this->userScoreService = $userScoreService;
        $this->repository = $repository;
    }

    public function setGift(ScoreGifts $gift,User $user,User $created_by)
    {
        $this->repository->add($gift->id,$user->id,$created_by->id);

    }
    public function deleteGift($user_gift_id)
    {
        $this->repository->delete($user_gift_id);

    }
    public function UserGetGift(ScoreGifts $gift,User $user)
    {
        if ($this->userScoreService->getScore($user) < $gift->score)
            throw ValidationException::withMessages(['user_score' => 'کاربر امتیاز لازم برای گرفتن هدیه را ندارد']);
        $this->setGift($gift,$user,$user);
        $this->userScoreService->addScore(-$gift->score,$gift,$user,'دریافت هدیه');

    }

}