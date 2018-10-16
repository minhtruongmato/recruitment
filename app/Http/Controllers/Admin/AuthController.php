<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterAdminRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use Auth;
use App\User;
use Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
    	if (Auth::check()) {
    		return redirect()->intended(route('admin.dashboard'));
    	};
    	return view('admin.user.login');
    }

    public function postLogin(LoginRequest $request)
    {
         
        $email = $request->email;
        $password = $request->password;
        // $level = 99;
      if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->intended('admin');
        }
        return redirect('admin/dang-nhap')->with('error','Tài khoản hoặc mật khẩu không đúng'); 
    }

    public function showRegister()
    {
        if (Auth::check()) {
            if (Auth::user()->level == 99) {
                return view('admin.user.register');
            }
            return redirect()->intended(route('admin.dashboard'))->with('error','Vui lòng đăng nhập quyền Quản trị viên');
        };
        return redirect()->intended(route('admin.postLogin'));
    }

    public function postRegister(RegisterAdminRequest $request)
    {
        $newuser = new User;
        $newuser->name = $request->name;
        $newuser->email = $request->email;
        $newuser->password = bcrypt($request->password);
        $newuser->level = 98;
        $newuser->active = 1;
        $newuser->save();
        return redirect('admin/dang-ky')->with('success','Đăng ký tài khoản thành công'); 
        
    }

    public function showChangePassword()
    {
        if (Auth::check()) {
            if (Auth::user()->level == 99 || Auth::user()->level == 98) {
                return view('admin.user.change');
            }
        };
    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Mật khẩu hiện tại không khớp với mật khẩu bạn đã cung cấp. Vui lòng thử lại.");
        }
 
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Mật khẩu mới không thể giống với mật khẩu hiện tại. Vui lòng chọn một mật khẩu khác.");
        }
 
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
 
        return redirect()->back()->with("success","Thay đổi mật khẩu thành công !");
    }

    public function showForgotPassword()
    {
        return view('admin.user.email');
    }

    public function postForgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        $user->sendResetPasswordEmail();
        return redirect('admin/quen-mat-khau')->with('success','Gửi Email thành công!'); 
    }

    public function showResetPassword($token)
    {
        $user = User::where('remember_token', $token)->firstOrFail();
        if ($user) {
            return view('admin.user.reset', ['token' => $token]);
        }
        
    }

    public function postResetPassword(ResetPasswordRequest $request, $token)
    {

        $password = bcrypt($request->new_password);
        if(User::where('remember_token', $token)->firstOrFail()->update(['password' => $password])){
            return redirect()->route('admin.getLogin')->with('success','Đổi mật khẩu thành công! Đăng nhập để thực hiện phiên làm viêc!'); 
        }else{
            return redirect()->route('admin.getLogin')->with('error','Đổi mật khẩu thất bại!'); 
        }
    }
    public function logout()
   	{
   		Auth::logout();
   		return redirect()->intended('admin/dang-nhap');
   	}
}
