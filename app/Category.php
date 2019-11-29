<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'name', 'description', 'parent_id'
    ];



    public function parent()
    {
        return $this->hasOne(Category::class,'id','parent_id');
    }

    public function books()
    {
        return $this->hasMany(Book::class,'category_id','id');
    }
}
