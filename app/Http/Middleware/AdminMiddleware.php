<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

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
        if(Auth::check()){
            $user = Auth::user();
            if($user->level == 99 || $user->level == 98){
                return $next($request);
            }else{
                Auth::logout();
                return redirect()->route('admin.getLogin')->with('errorLogin','Vui lòng đăng nhập quyền Quản trị viên');
            }
        }else{
            return redirect('admin/dang-nhap')->with('errorLogin','Bạn chưa đăng nhập');
        }
    }
}
