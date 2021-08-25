<?php

use App\Events\AdminRegisterEvent;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('register', function () {
        return view('admin.register');
    })->name('register')->middleware('guest:admin');
    
    Route::post('register', function (Request $request) {
        // return $request->all();
        $request->validate([
            'name'=> ['required'],
            'email'=> ['required'],
            'password'=> ['required'],
            'con-password'=> ['required']
        ]);
    
        $admin = Admin::create($request->only('name', 'email', 'password'));
        // event(new Registered($user));
        event(new AdminRegisterEvent($admin));
        $request->session()->regenerate();
        Auth::guard('admin')->login($admin);   
        return redirect()->intended('admin/dashboard');
    
    })->name('register');

    Route::get('login', function () {
        return view('admin.login');
    })->name('login')->middleware('guest:admin');
    
    Route::post('login', function (Request $request) {
        // return $request->all();
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
    
            return redirect()->intended('admin/dashboard');
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    })->name('login');

    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard')->middleware(['auth:admin', 'custom_verifiy']);

    Route::post('logout', function (Request $request) {

        Auth::guard('admin')->logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('admin/login');
    })->name('logout');

    // Send Varification Email------->


    Route::get('/email/verify', function () {
        return view('admin.verify-email');
    })->middleware('auth:admin')->name('verification.notice');
    
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect('admin/dashboard');
    })->middleware(['auth:admin', 'signed'])->name('verification.verify');

    // Resend Email------->

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth:admin', 'throttle:6,1'])->name('verification.send');


    // Forget Password------->

    Route::get('/forgot-password', function () {
        return view('admin.forgot-password');
    })->middleware('guest:admin')->name('password.request');

    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email|exists:admins,email']);

        $status = Password::broker('admins')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    })->middleware('guest:admin')->name('password.email');

    Route::get('/reset-password/{token}', function ($token) {
        return view('admin.reset-password', ['token' => $token]);
    })->middleware('guest:admin')->name('password.reset');

    Route::post('/reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker('admins')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => $password
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('admin.login')->with('status', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    })->middleware('guest:admin')->name('password.update');



});