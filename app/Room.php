<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');

    }
}
