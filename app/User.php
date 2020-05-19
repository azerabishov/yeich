<?php

namespace App;

use App\Notifications\ResetNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,Notifiable;


    protected $guarded = [];
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function collections()
    {
        return $this->hasMany('App\Collection','user_id');
    }

    public function rating()
    {
        return $this->hasMany('App\Rating');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetNotification($token));
    }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }

}
