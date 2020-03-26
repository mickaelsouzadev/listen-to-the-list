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
		$this->model::create($data);
	} 
}