<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', 'UserController@login');

Route::post('/register', 'UserController@register');

Route::post('/social-login', 'UserController@socialLogin');

Route::post('/social-register', 'UserController@socialRegister');

Route::post('/albums', 'AlbumListController@store');

Route::get('/list/{id}', 'AlbumListController@index')->middleware('auth:sanctum');;