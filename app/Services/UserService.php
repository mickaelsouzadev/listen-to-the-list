<?php  

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Repositories\UserRepository;

class UserService {

	private $repository;

	public function __construct(UserRepository $repository) 
	{
		$this->repository = $repository;
	}

	public function createUser($request) 
	{
		$request['password'] = Hash::make($request['password']);

		$user = $this->repository->create($request->only('name', 'email', 'password'));

		if($user) {

			$token = $user->createToken('my-app-token')->plainTextToken;

			return response()->apiAuthenticationSuccess($user, $token);
		}

		return response()->apiAuthenticationOrRegisterFailed('Não foi possível cadastrar o usuário!');

	}


	public function createUserBySocialLogin($request) 
	{
		$access_token = $request->input('access_token');

		$social_user = Socialite::driver('google')->userFromToken($access_token);


		$data = array(
			'name'=>$social_user['name'],
			'email'=>$social_user['email'],
			'social_id'=>$social_user['id'],
			'password'=>Hash::make(Str::random(40))
		);

		$user = $this->repository->create($data);

		if($user) {

			$token = $user->createToken('my-app-token')->plainTextToken;

			return response()->apiAuthenticationSuccess($user, $token);
		}

		return response()->apiAuthenticationOrRegisterFailed('Não foi possível cadastrar o usuário!');
		
	}

	public function authenticateUser($request) 
	{
		$credentials = $request->only('email', 'password');
	
		if (Auth::attempt($credentials)) {
	        $user = $this->repository->findUserByEmail($credentials['email']);

	        $token = $user->createToken('my-app-token')->plainTextToken;

			return response()->apiAuthenticationSuccess($user, $token);
        }

        return response()->apiAuthenticationOrRegisterFailed('Usuário ou senha incorreto(s)');
	}

	public function authenticateUserBySocialLogin($request)
	{
		$access_token = $request->input('access_token');

		$social_user = Socialite::driver('google')->userFromToken($access_token);

		$user = $this->repository->findUserBySocialId($social_user['id']);

		if($user) {

			$token = $user->createToken('my-app-token')->plainTextToken;

			return response()->apiAuthenticationSuccess($user, $token);
		}

		return response()->apiAuthenticationOrRegisterFailed('Usuário não cadastrado!');

	}

}