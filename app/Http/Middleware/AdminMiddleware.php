<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Facades\Admin;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::guest()) {
            $user = Admin::model('User')->find(Auth::id());

            return $user->hasPermission('browse_admin')? $next($request) : redirect('/');
        }

        $urlLogin = route('admin.test');
        echo $urlLogin;die;

        return redirect($urlLogin);
    }
}
