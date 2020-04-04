<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
	use HasApiTokens, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'social_id'];

    public function albums()
    {
    	return $this->belongsToMany('App\Album')->using('App\AlbumUser');;
    }
}
