<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlbumUser extends Model
{
    protected $fillable = ['user_id', 'album_id'];
}
