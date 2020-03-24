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

    public function socialRegister(Request $request) 
    {
    	$access_token = $request->input('access_token');

    	$social_user = Socialite::driver('google')->userFromToken($access_token);

    	$created = User::create([
    		'name'=>$social_user['name'],
    		'email'=>$social_user['email'],
    		'password' => Hash::make($social_user['id']),
    	]);

    	return response()->json($created, 200);
    }
}
