<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CTag extends Model
{
    protected $fillable = ['title'];

    public static function isExist($value){
        $tag= null;
        if(ctype_digit($value))
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
