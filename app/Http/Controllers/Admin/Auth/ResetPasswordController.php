<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    public function reset_password(Request $request, $token){
        return view('admin.auth.reset_password')->with([
            'token' => $token,
            'email' => $request->email
        ]);
    }

    public function update_password(Request $request){
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $response = Password::broker('admins')->reset($request->only('email', 'password', 'token'), function ($admin, $password) {
            $admin->password = bcrypt($password);
            $admin->save();

            Auth::guard('admin')->login($admin);
        });

        if ($response == Password::PASSWORD_RESET) {
            session()->flash('success', 'Password reset successfully!');
            return redirect()->route('admin.dashboard');
        } else {
            session()->flash('error', 'Link expired please try again!');
            return redirect()->route('admin.auth.forgot_password');
        }
    }
}
