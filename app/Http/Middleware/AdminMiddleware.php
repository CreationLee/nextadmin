<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Facades\AdminFacades;


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
            $user = AdminFacades::model('user')->find(Auth::id());

            return $user->hasPermission('browse_admin') ? $next($request) : redirect( '/' );
        }

        $urlLogin = route('login');
        $urlIntended = $request->url();
        if($urlLogin == $urlIntended) {
            $urlIntended = null;
        }

        return redirect($urlLogin)->with('url.intended',$urlIntended); //with方法带一个session参数，重定向


    }
}
