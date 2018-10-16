<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function reset($token)
    {
    	$user = User::where('remember_token', $token)->firstOrFail();
}
