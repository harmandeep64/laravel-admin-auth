<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }

    public function verify(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|digits:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->is_remember)){
            session()->flash('success', 'Welcome back!');
            return redirect()->route('admin.dashboard');
        }

        session()->flash('error', 'Username or password is incorrect!');
        return redirect()->back()->withInput();
    }
}
