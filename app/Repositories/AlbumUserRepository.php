<?php 

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\AlbumUser;

class AlbumUserRepository extends BaseRepository
{

	public function __construct(AlbumUser $model)
	{
		parent::__construct($model);
	}

}