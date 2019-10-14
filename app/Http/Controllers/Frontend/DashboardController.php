<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Auth;


/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        if (!isset($user)) return redirect()->route('login');

        if ($user->isBack()) return view('backend.dashboard');
        if ($user->isFront()) return view('frontend.dashboard');

        return redirect()->route('home');
    }
}
