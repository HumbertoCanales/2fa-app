<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

// Route::get('/', function () {
//     return view('auth.login');
// });

//Auth::routes();
Route::get('/', function() {
    return redirect('home');
});

Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.post');
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'index'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register.post');

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['2fa', 'auth']);

Route::get('2fa/{id}', [App\Http\Controllers\TwoFAController::class, 'getSignedUrl']);
Route::get('2fa', function(Request $request) {
    if (! $request->hasValidSignature()) {
        Auth::logout();
        Session::forget('user_2fa');
        return redirect("login")->withError('Se superó el tiempo para la doble autenticación');
    }
    return view('2fa');
})->name('2fa.index')->middleware(['act2fa', 'auth']);
Route::post('2fa', [App\Http\Controllers\TwoFAController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [App\Http\Controllers\TwoFAController::class, 'resend'])->name('2fa.resend');
