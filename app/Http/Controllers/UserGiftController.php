<?php

namespace App\Http\Controllers;

use App\Http\Requests\deleteUserGiftRequest;
use App\Http\Requests\SetUserGiftRequest;
use App\ScoreGifts;
use App\Services\UserGiftService\UserGiftService;
use App\User;
use App\UserGift;
use Illuminate\Http\Request;

class UserGiftController extends Controller
{
    protected $service;

    public function index()
    {
        return UserGift::with(['user','scoreGift','order'])->paginate();
    }
    public function __construct(UserGiftService $service)
    {
        $this->service = $service;
    }

    public function store(SetUserGiftRequest $requset)
    {
        $this->service->setGift(ScoreGifts::findOrFail($requset->gift_id),User::findOrFail($requset->user_id),auth()->user());
    }
    public function destroy(deleteUserGiftRequest $requset)
    {
        $this->service->deleteGift($requset->id);
    }
}
