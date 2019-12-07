<?php


namespace App\Services\UserGiftService\UserGiftRepository;


use App\ScoreGifts;
use App\UserGift;

class UserGiftRepository
{

    public function add($gift_id,$user_id,$created_by)
    {
        UserGift::create([
            'score_gift_id' =>$gift_id,
            'user_id' =>$user_id,
            'created_by' =>$created_by,
        ]);
    }
    public function delete($user_gift_id)
    {
        UserGift::where('id',$user_gift_id)->delete();
    }
    public function aUserGift($user_id)
    {
        return UserGift::where('user_id',$user_id)->get();
    }
    public function availableUserGift($user_id)
    {
        return UserGift::NotUsed()->where('user_id',$user_id)->with('scoreGift')->get();
    }
    public function availableScoreGift($user_id)
    {
//        return ScoreGifts::join('user_gifts','user_gifts.score_gift_id','=','score_gifts.id')
//            ->where('user_id',$user_id)
//            ->whereNull('used_order_id')
//            ->get();
        return UserGift::NotUsed()->where('user_id',$user_id)->with('scoreGift')->get();
    }

}