<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AlbumUser extends Pivot
{
    protected $fillable = ['user_id', 'album_id'];
}
