<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

    protected $guarded = [];
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }
}
