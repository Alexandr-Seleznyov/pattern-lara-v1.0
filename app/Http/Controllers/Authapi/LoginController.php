<?php

namespace App\Http\Controllers\Authapi;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Auth;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest')->except('logout');
    }



    public function index()
    {
        return view('authapi.login');
    }



    public function postLogin(Request $request)
    {
        $error = null;

        $loginDate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);

        $error = null;

        try {
            $post = $client->post(
                route('api.v1.login'),
                [
                    'body' => json_encode($loginDate)
                ]
            );

        } catch (RequestException $e) {
            $error = $e;
        }

        $response = back()->withInput();

        if(isset($error)) {
            $answer = json_decode($error->getResponse()->getBody()->getContents(), true);
            $response->withErrors($answer['errors']);
            // $answer['status'] = $error->getCode(); // 422
        } else {
            $answer = json_decode($post->getBody()->getContents(), true);

            if(array_key_exists('user', $answer)){

                $user = User::find($answer['user']['id']);

                if(isset($user)) {
                    Auth::login($user, true);
                    return redirect(route('frontend.dashboard'));
                } else {
                    $answer['message'] = 'User is not found';
                }
            }

            $answer['status'] = $post->getStatusCode();
            $response->with($answer);
        }

        return $response;
    }




}
