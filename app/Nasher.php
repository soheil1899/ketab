<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nasher extends Model
{
    public function books()
    {
        return $this->hasMany(Book::class,'nasher_id','id');
    }
}
