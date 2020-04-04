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
		$album = $this->albumRepository->create($request->only('id', 'name', 'artist_name', 'img'));

		$data = [
			'album_id'=>$album['id'],
			'user_id'=>$request->input('user_id')
		];

		$this->albumUserRepository->create($data);

		if(!$album) {
			return response()->apiOperationFailed('Não foi possível adicionar esse albúm a sua lista!');
		}
	}
}
