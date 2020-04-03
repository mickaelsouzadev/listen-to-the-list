<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

	protected $fillable = ['id', 'name', 'artist_name'];

    public function users()
    {
    	return $this->belongsToMany('App\User', 'user_has_albums');
    }
}
