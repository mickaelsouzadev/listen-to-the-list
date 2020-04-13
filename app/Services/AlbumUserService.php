<?php 

namespace App\Services;

use App\Repositories\AlbumRepository as Album;
use App\Repositories\AlbumUserRepository as AlbumUser;
use App\Repositories\UserRepository as User;

class AlbumUserService 
{
	private $albumUserRepository;
	private $albumRepository;
	private $userRepository;

	public function __construct(AlbumUser $albumUser, Album $album, User $user)
	{
		$this->albumUserRepository = $albumUser;
		$this->albumRepository = $album;
		$this->userRepository = $user;
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

	public function getAlbumList($id)
	{
		$user = $this->userRepository->find($id);

		return $user->albums;
	}
}
