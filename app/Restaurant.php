<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $guarded = [];

    public function menu()
    {
        return $this->hasOne('App\Menu');
    }

    public function images()
    {
        return $this->morphMany('App\Image','imageable');
    }

    public function offers()
    {
        return $this->hasMany('App\Offer');
    }

    public function collections()
    {
        return $this->belongsToMany('App\Collection');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category','tag_restaurant');
    }


    public function rooms()
    {
        return $this->hasMany('App\Room');

    }


}
