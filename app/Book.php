<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function nasher()
    {
        return $this->belongsTo(Nasher::class,'nasher_id','id');
    }

    public function writer()
    {
        return $this->belongsTo(Writer::class,'writer_id','id');
    }

    public function translator()
    {
        return $this->belongsTo(Writer::class,'translator_id','id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
