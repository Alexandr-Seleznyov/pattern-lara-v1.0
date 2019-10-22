<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }



    public function show($id)
    {
        return User::findOrFail($id);
    }



    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        return $user;
    }



    public function store(Request $request)
    {
        $user = User::create($request->all());
        return $user;
    }



    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return '';
    }



    // For Demo
    public function get(Request $request)
    {
        $user_id = $request->get("uid", 0);
        $user = User::find($user_id);
        return $user;
    }
}
