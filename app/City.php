<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public static function findbyname($q)
    {
        $term = trim($q);

        if (empty($term)) {
            return json_encode([]);
        }

        $tags = self::where('name','like','%'.$term.'%')->limit(5)->get();

        $formatted_tags = [];

        foreach ($tags as $tag) {
            $formatted_tags[] = ['id' => $tag->id, 'text' => $tag->name];
        }

        return json_encode($formatted_tags);
    }
    public function province(){
        return $this->belongsTo(Province::class);
    }
}
