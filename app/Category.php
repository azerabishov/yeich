<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];



    public function restaurants()
    {
        return $this->belongsToMany('App\Restaurant','tag_restaurant');
    }
}
