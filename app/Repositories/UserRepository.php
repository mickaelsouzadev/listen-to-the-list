<?php  

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\User;

class UserRepository extends BaseRepository
{
	public function __construct(User $model) 
	{
		parent::__construct($model);
	}

	public function findUserBySocialId($socialId)
	{
		return $this->model::where(['social_id' => $socialId])->first();
	}

	public function findUserByEmail($email) 
	{
		return $this->model::where(['email'=>$email])->first();
	}

}