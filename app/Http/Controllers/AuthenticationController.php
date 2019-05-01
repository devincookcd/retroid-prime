<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Lcobucci\JWT\Parser;
use App\User;
use Response;

class AuthenticationController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request) {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);
        $token = $request->user()->createToken('Laravel Password Grant Client')->accessToken;

        return Response::json([
            'success' => true,
            'user' => $request->user(),
            'token' => $request->user()->createToken('Laravel Password Grant Client')->accessToken
        ]);
    }

    public function logout(Request $request) {
        $value = $request->bearerToken();
        $id = (new Parser())->parse($value)->getHeader('jti');
        $token = $request->user()->tokens->find($id);
        $token->revoke();
        $response = 'You have been successfully logged out!';
        return response($response, 200);
    }
}
