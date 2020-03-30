<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{

	protected $service;

	public function __construct(UserService $service)
	{
		$this->service = $service;
	}

    public function register(Request $request) 
    {
        return $this->service->createUser($request);
    }

    public function socialRegister(Request $request) 
    {
    	return $this->service->createUserBySocialLogin($request);

    }

    public function login(Request $request)
    {
       return $this->service->authenticateUser($request);
       
    }

    public function socialLogin(Request $request)
    {
    	return $this->service->authenticateUserBySocialLogin($request);
    }
}
