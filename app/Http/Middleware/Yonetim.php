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
        if ($this->IsYonetim()==false)
        {
            return redirect()->route('register');
        };
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
