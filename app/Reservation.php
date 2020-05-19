<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $guarded = [];

    public function rating()
    {
        return $this->hasOne('App\Rating');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }
}
