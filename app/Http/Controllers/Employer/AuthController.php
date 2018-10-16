<?php

namespace App\Http\Controllers\Employer;

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
    		return redirect()->intended(route('employer.dashboard'));
    	};
    	return view('employer.user.login');
    }

    public function postLogin(LoginRequest $request)
    {
         
        $email = $request->email;
        $password = $request->password;
      if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->route('employer.dashboard');
        }
        return redirect()->route('employer.getLogin')->with('error','Tài khoản hoặc mật khẩu không đúng'); 
    }

    public function showRegister()
    {
        if (!Auth::check()) {
            return view('employer.user.register');
        }else{
            return redirect()->route('employer.dashboard');
        }
    }

    public function postRegister(RegisterAdminRequest $request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['level'] = 89;
        $data['verified_token'] = str_random(25);
        $user = User::create($data);

        $user->sendVerificationEmail();
        return redirect('employer/dang-ky')->with('success','Đăng ký tài khoản thành công. Vui lòng kiểm tra Email để kích hoạt tài khoản!'); 
    }

    public function showChangePassword()
    {
        if (Auth::check()) {
            if (Auth::user()->level == 89) {
                return view('employer.user.change');
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
        return view('employer.user.email');
    }

    public function postForgotPassword(ForgotPasswordRequest $request)
    {
        $user = User::where(['email' => $request->email, 'active' => 1])->first();
        if ($user) {
            $user->sendEmployerResetPasswordEmail();
            return redirect()->route('employer.getForgot')->with('success','Gửi Email thành công!'); 
        }else{
            return redirect()->route('employer.getForgot')->with('error','Email không đúng hoặc tài khoản chưa kích hoạt. Vui lòng kiểm tra lại!'); 
        }
        
    }

    public function showResetPassword($token)
    {
        $user = User::where('remember_token', $token)->firstOrFail();
        if ($user) {
            return view('employer.user.reset', ['token' => $token]);
        }
        
    }

    public function postResetPassword(ResetPasswordRequest $request, $token)
    {

        $password = bcrypt($request->new_password);
        if(User::where('remember_token', $token)->firstOrFail()->update(['password' => $password])){
            return redirect()->route('employer.getLogin')->with('success','Đổi mật khẩu thành công! Đăng nhập để thực hiện phiên làm viêc!'); 
        }else{
            return redirect()->route('employer.getLogin')->with('error','Đổi mật khẩu thất bại!'); 
        }
    }
    
    public function logout()
   	{
   		Auth::logout();
   		return redirect()->route('employer.getLogin');
   	}
}
