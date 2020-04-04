<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

	protected $fillable = ['id', 'name', 'artist_name', 'img'];
	public $incrementing = false;

    public function users()
    {
    	return $this->belongsToMany('App\User', 'album_user');
    }
}
