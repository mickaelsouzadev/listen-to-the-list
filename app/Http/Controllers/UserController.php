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
    	$this->service->createUserBySocialLogin($request);
    }

    public function login()
    {

    }

    public function socialLogin(Request $request)
    {
    	$response = $this->service->authenticateUserBySocialLogin($request);

    	return response()->json($response, 200);
    }
}
