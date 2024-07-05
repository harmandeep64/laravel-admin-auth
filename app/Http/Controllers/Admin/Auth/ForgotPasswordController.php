<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\AdminResetPasswordEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Random;

class ForgotPasswordController extends Controller
{
    public function forgot_password(){
        return view('admin.auth.forgot_password');
    }

    public function send_token(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin = Admin::where('username', $request->username)->where('status', 1)->first();

        if ($admin){
            $token = Password::broker('admins')->createToken($admin);
            $admin->notify(new AdminResetPasswordEmail($token));

            session()->flash('success', 'Password reset link sent to your email.');
            return redirect()->back();
        }

        session()->flash('error', 'Username not exists!');
        return redirect()->back()->withInput();

    }
}
