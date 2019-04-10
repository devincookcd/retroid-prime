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
        // $request->session()->invalidate();
        // $request->session()->regenerate();

        $this->clearLoginAttempts($request);
        return Response::json([
            'success' => true,
            'user' => $request->user(),
            'token' => $request->user()->createToken('Laravel Password Grant Client')->accessToken,
            'apiToken' => $request->user()->api_token,
            'honkler' => 'clown world'
            // 'csrfToken' => csrf_token()
            // 'apiToken' => $current_user
        ]);
    }

    public function logout(Request $request) {
        $value = $request->bearerToken();
        $id= (new Parser())->parse($value)->getHeader('jti');
        $token= $request->user()->tokens->find($id);
        $token->revoke();
        $response = 'You have been successfully logged out!';
        return response($response, 200);
    }

    // /**
    //  * Validate the user login request.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return void
    //  *
    //  * @throws \Illuminate\Validation\ValidationException
    //  */
    // protected function validateLogin(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|string',
    //         'password' => 'required|string',
    //     ]);
    // }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    // protected function attemptLogin(Request $request)
    // {
    //     return $this->guard()->attempt(
    //         $this->credentials($request), $request->filled('remember')
    //     );
    // }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    // protected function credentials(Request $request)
    // {
    //     return $request->only('email', 'password');
    // }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    // protected function guard()
    // {
    //     return Auth::guard();
    // }
}
