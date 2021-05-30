<?php

namespace App;

use App\Traits\CooperationAccountTrait;
use Illuminate\Database\Eloquent\Model;

class CTag extends Model
{
    use CooperationAccountTrait;

    protected $fillable = ['title'];

    public function cooperationAccount()
    {
        return $this->belongsTo(CooperationAccount::class, 'co_account_id', 'id');
    }

    public static function isExist($value){
        $tag= null;
        if(ctype_digit($value) || is_int($value))
            $tag = CTag::find($value);
        if ($tag)
            return $tag->id;

        $tag = CTag::where('title',$value)->first();
        if ($tag)
            return $tag->id;
        return null;

    }

    public static function FindOrCreate($value)
    {
        $tag_id = static::isExist($value);
        if(!$tag_id)
            $tag_id= self::create(['title' => $value])->id;
        return $tag_id;
    }
}
