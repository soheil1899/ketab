<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Writer extends Model
{
    public function wbooks()
    {
        return $this->hasMany(Book::class,'writer_id','id');
    }

    public function tbooks()
    {
        return $this->hasMany(Book::class,'translator_id','id');
    }
}
