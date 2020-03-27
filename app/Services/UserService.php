<?php  

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Repositories\UserRepository;

class UserService {

	protected $repository;

	public function __construct(UserRepository $repository) 
	{
		$this->repository = $repository;
	}

	public function createUserBySocialLogin($request) 
	{
		$access_token = $request->input('access_token');

		$social_user = Socialite::driver('google')->userFromToken($access_token);


		$data = array(
			'name'=>$social_user['name'],
			'email'=>$social_user['email'],
			'social_id'=>$social_user['id'],
		);

		$user = $this->repository->create($data);

		return response()->json(['message'=>'Sucesso!'], 200);
	}

	public function authenticateUserBySocialLogin($request)
	{
		$access_token = $request->input('access_token');

		$social_user = Socialite::driver('google')->userFromToken($access_token);

		$user = $this->repository->findUserBySocialId(['social_id' => $social_user['id']]);

		$token = $user->createToken('my-app-token')->plainTextToken;

		$response = [
			'token' => $token,
			'user' => $user,
		];

		return $response;

	}

}