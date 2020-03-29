<?php  

namespace App\Repositories;
use App\User;

class UserRepository 
{
	private $model;

	public function __construct() 
	{
		$this->model = new User();
	}

	public function create($data)
	{
		return $this->model::create($data);
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