<?php 

namespace App\Services;

use App\Repositories\AlbumRepository as Album;
use App\Repositories\AlbumUserRepository as AlbumUser;

class AlbumUserService 
{
	private $albumUserRepository;
	private $albumRepository;

	public function __construct(AlbumUser $albumUser, Album $album)
	{
		$this->albumUserRepository = $albumUser;
		$this->albumRepository = $album;
	}

	public function addAlbumAndUserToList($request)
	{
		dd($this->albumRepository->create($request));
	}
}
