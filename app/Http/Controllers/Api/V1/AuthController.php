<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validateDate = $request->validate([
            'name' => 'required|max:55',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $validateDate['password'] = bcrypt($request->password);

        $user = User::create($validateDate);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user' => $user,
            'access_token' => $accessToken,
        ]);
    }



    public function login(Request $request)
    {
        $loginDate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
//            'abc' => 'required',
        ]);

        if(!auth()->attempt($loginDate)) {
            return response([
                'message' => 'Invalid credentials',
            ]);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response([
            'user' => auth()->user(),
            'access_token' => $accessToken,
        ]);
    }

}
