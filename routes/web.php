<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SkillController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;


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


Route::get('register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::post('register', function (Request $request) {
    // return $request->all();
    $request->validate([
        'name'=> ['required'],
        'email'=> ['required'],
        'password'=> ['required'],
        'con-password'=> ['required']
    ]);

    $user = User::create($request->only('name', 'email', 'password'));
    event(new Registered($user));
    $request->session()->regenerate();
    Auth::guard('web')->login($user); 
    return redirect()->intended('category');

})->name('register');

Route::get('login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::post('login', function (Request $request) {
    // return $request->all();
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::guard('web')->attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended('category');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
})->name('login');

// Route::get('/dashboard', function () {
//     return view('auth.dashboard');
// })->name('dashboard')->middleware(['auth', 'verified']);

Route::post('/logout', function (Request $request) {

    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('login');
})->name('logout');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/category');
})->middleware(['auth', 'signed'])->name('verification.verify');

// Resend Email------->

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// Forget Password------->

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email|exists:users,email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
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
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');




Route::resource('/category', CategoryController::class)->middleware(['auth', 'verified']);

// Getes Middleware e use --->
// Route::get('post', fn () => 'Protected!')->middleware('can:isAdmin')->name('post');

// Route::get('/posts/update', '[PostController::class,'update'])->middleware('can:isEditor')->name('post.update');

// Route::get('/posts/create', 'PostController@create')->middleware('can:isUser')->name('post.create');

Route::get('admin-can-access', function () {
    return 'Admin can access';

})->middleware(['can:isEditor, isAdmin']);


// policy

Route::resource('/skill', SkillController::class)->middleware(['auth', 'verified']);

// policy in middleware

// use App\Models\Post;

// Route::put('/post/{post}', function (Post $post) {
//     // The current user may update the post...
// })->middleware('can:update,post');

// # Or You can also use it to avoiding models.

// Route::post('/post', function () {
//     // The current user may create posts...
// })->middleware('can:create,App\Models\Post');


// Cache--->

Route::get('/cache', function () {

    // return Cache::get('name', 'This is default value');


    // Cache::get('category', function(){
    //     return Category::get();
    // }, 100);


    // if(Cache::has('category')){
    //     return "Ok";
    // }else{
    //     return "no";
    // }

    // remove cache data---------->
    // return Cache::forget('caches');

    $caches = Cache::rememberForever('caches', function () {
        return Category::get();
    });

    // $caches = Category::all();
    return view('cache.index', compact('caches'));
})->name('cache')->middleware('auth');