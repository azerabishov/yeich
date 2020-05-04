<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public function rating()
    {
        return $this->hasOne('App\Rating');

    }
}
