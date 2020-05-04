<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function reservation()
    {
        return $this->belongsTo('App\Reservation');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
