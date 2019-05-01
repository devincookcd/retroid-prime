<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;

class UserController extends Controller
{
    //

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            // 'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new flight instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function save(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $request->user();

        $user->update([
            'name' => $request->name
        ]);

        return [
            'user' => $user,
            'name' => $request->name
        ];
    }
}
