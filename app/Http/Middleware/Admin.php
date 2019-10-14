<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class Admin.
 */
class Admin
{
    /**
     * @param         $request
     * @param Closure $next
     *
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();

        if(!$user->isBack()) {
            $redirect = redirect()->route('frontend.dashboard');
            $redirect->withFlashDanger('Access denied');
            return $redirect;
        }

        return $next($request);
    }
}
