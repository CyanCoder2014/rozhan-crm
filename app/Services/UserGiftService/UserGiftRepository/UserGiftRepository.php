<?php


namespace App\Services\UserGiftService\UserGiftRepository;


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

}