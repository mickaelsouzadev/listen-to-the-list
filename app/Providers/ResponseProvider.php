<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('apiAuthenticationSuccess', function($user, $token) {
            return [
                'user' => $user,
                'token' => $token,
            ];
        });

        Response::macro('apiAuthenticationOrRegisterFailed', function($message) {
            return Response::json(
                [
                    'message'=> $message
                ], 401
            );
        }) ;
    }
}
