<?php

namespace App\Http\Middleware;

use App\User;
use Auth;
use Closure;

class Yonetim
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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['KCFINDER'] = array();
        if ($this->IsYonetim()==false)
        {
            $_SESSION['KCFINDER']['disabled'] = true;
            return redirect()->route('login');
        };
        $_SESSION['KCFINDER']['disabled'] = false;
        return $next($request);

    }
    public function IsYonetim()
    {
        $id= Auth::id();

        $rol=User::where('id','=',$id)->where('admin_user',1)->first();
        if ($rol)
            return true;
        else
            return false;

    }
}
