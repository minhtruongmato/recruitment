<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verify($token)
    {
    	$user = User::where('verified_token', $token)->update(['verified_token' => null, 'active' => 1]);
    	return redirect()->route('employer.dashboard')->with('successRegister', 'Xác nhận Email thành công!');
    }
}
