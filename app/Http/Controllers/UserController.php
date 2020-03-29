<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
// use Illuminate\Support\Facades\Auth;
// // use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

	protected $service;

	public function __construct(UserService $service)
	{
		$this->service = $service;
	}

    public function register() 
    {

    }

    public function socialRegister(Request $request) 
    {
    	$response = $this->service->createUserBySocialLogin($request);

        if($response) {
            return response()->json($response, 200);
        }

        return response()->json(['message'=> 'Não foi possível cadastrar o seu usuário'], 401);
    }

    public function login(Request $request)
    {
        $response = $this->service->authenticateUser($request);

        if($response) {
            return response()->json($response, 200);
        }

        return response()->json(['message'=> 'Usuário ou senha incorretos'], 401);
       
    }

    public function socialLogin(Request $request)
    {
    	$response = $this->service->authenticateUserBySocialLogin($request);

        if($response) {
            return response()->json($response, 200);
        }

    	 return response()->json(['message'=> 'Usuário não cadastrado'], 401);
       
    }
}
