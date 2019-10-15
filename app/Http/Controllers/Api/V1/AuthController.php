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
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user = User::create($validateDate);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user' => $user,
            'access_token' => $accessToken,
        ]);
    }


    public function login(Request $request)
    {

    }

}
