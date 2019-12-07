<?php

namespace App\Http\Controllers\API\Client\v1;

use App\Http\Requests\Client\Gifts\ClientGetGiftRequest;
use App\ScoreGifts;
use App\Services\UserGiftService\UserGiftService;
use App\UserGift;
use App\Http\Controllers\Controller;

class ClientGiftController extends Controller
{
    protected $service;
    public function __construct(UserGiftService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return UserGift::where('user_id',auth()->id())->paginate();
    }

    public function store(ClientGetGiftRequest $requset)
    {
        $this->service->UserGetGift(ScoreGifts::findOrFail($requset->gift_id),auth()->user());
    }
}
