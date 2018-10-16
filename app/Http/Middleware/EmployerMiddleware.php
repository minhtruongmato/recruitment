<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class EmployerMiddleware
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
        if(Auth::check()){
            $user = Auth::user();
            if($user->level == 89 && $user->active == 1){
                return $next($request);
            }elseif($user->level != 89){
                Auth::logout();
                return redirect()->route('employer.getLogin')->with('error','Vui lòng đăng nhập tài khoản nhà tuyển dụng');
            }elseif($user->active == 0){
                Auth::logout();
                return redirect()->route('employer.getLogin')->with('error','Tài khoản chưa kích hoạt');
            }
        }else{
            return redirect()->route('employer.getLogin')->with('error','Bạn chưa đăng nhập');
        }
    }
}
