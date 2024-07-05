<?php

use App\Http\Middleware\Admin\Authenticate;
use App\Http\Middleware\Admin\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'App\Http\Controllers\Admin'], function () {

    Route::get("/", function (){
        return redirect()->route('admin.auth.login');
    });

    Route::get('logout', function (){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.auth.login');
    })->name('logout');


    Route::group(['middleware' => [RedirectIfAuthenticated::class], 'as' => 'auth.', 'namespace' => 'Auth'], function (){

        Route::get('login', 'LoginController@login')->name('login');

        Route::post('verify', 'LoginController@verify')->name('login.verify');

        Route::get('forgot-password', 'ForgotPasswordController@forgot_password')->name('forgot_password');

        Route::post('send-verification-email', 'ForgotPasswordController@send_token')->name('forgot_password.send-token');

        Route::get('reset-password/{token}', 'ResetPasswordController@reset_password')->name('reset_password');

        Route::post('update/reset-password', 'ResetPasswordController@update_password')->name('reset_password.update');

    });

    Route::group(['middleware' => [Authenticate::class]], function (){

        Route::get('dashboard', 'DashboardController@index')->name('dashboard');

        Route::group(['as' => "profile."], function (){

            Route::get('/', 'ProfileController@view')->name('view');

            Route::post('update-profile', 'ProfileController@update_profile')->name('update');

            Route::post('update-password', 'ProfileController@update_password')->name('update_password');

        });

    });

});
