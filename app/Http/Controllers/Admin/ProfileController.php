<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function view() {
        $admin = Admin::where('id', Auth::guard('admin')->id())->first();
        $countries = Country::active()->get();

        return view('admin.profile.index')->with([
            'admin' => $admin,
            'countries' => $countries
        ]);
    }

    public function update_profile(Request $request){
        $id = Auth::guard('admin')->id();
        $country_code = Country::where('id', $request->country_id)->first();

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins,username,' . $id,
            'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
            'country_id' => 'required',
            'phone_number' => ['required', 'string', 'min:' . $country_code->min_phone_number_length, 'max:' . $country_code->max_phone_number_length, 'unique:admins,phone_number,'. $id],
        ]);

        $update = $request->only('name','username','email','phone_number');
        $update['country_code'] = $country_code->country_code;

        Admin::where('id', $id)->update($update);

        session()->flash('success', 'Admin updated successfully');
        return redirect()->route('admin.dashboard');
    }

    public function update_password(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $id = Auth::guard('admin')->id();
        $admin = Admin::where('id', $id)->first();

        if (!Hash::check($request->old_password, $admin->password)) {
            session()->flash('error', 'The old password is incorrect.');
            return redirect()->back();
        }

        Admin::where('id', $id)->update([
            "password"  => Hash::make($request->password)
        ]);

        session()->flash('success', 'Password updated successfully.');
        return redirect()->route('admin.dashboard');
    }
}
