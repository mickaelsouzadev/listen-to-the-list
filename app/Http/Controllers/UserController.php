<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function register() 
    {

    }

    public function socialRegister(Reqeust $request) 
    {
    	$access_token = $request->input('access_token');

    	$social_user = Socialite::driver('google')->userFromToken($access_token);
    }
}
