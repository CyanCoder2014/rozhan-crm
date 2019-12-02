<?php


namespace App\Services\UserScoreService\UserScoreRepository;


use App\UserScore;

class UserScoreRepository
{
    public function add($amount,$model_name,$model_id,$user_id,$title,$created_by_id=null)
    {
        return UserScore::create([
           'score' => $amount,
           'user_id' => $user_id,
           'reference_type' => $model_name,
           'reference_id' => $model_id,
           'description' => $title,
           'created_by' => $created_by_id,
        ]);//->toArray();
    }
    public function getUserScore($user_id)
    {
        return UserScore::where('user_id',$user_id)->sum('score');//->toArray();
    }

}