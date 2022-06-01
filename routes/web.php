<?php

use App\Http\Middleware\IsAdmin;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
Route::get('/maps', function(){
    return view('maps');
});
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/register', function(){
    return redirect('/');
});
Route::get('/notice', function(){
    // return view('auth.verify-email');
    // return view('auth.verify');
    session()->flash('status',['code'=>400, 'message'=>"Email not yet verified. Please check your email and verifiy this account"]);
    auth()->user()->sendEmailVerificationNotification();
    auth()->logout();
    return redirect()->back();
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function ($id, $hash) {
    $user = User::find($id)->markEmailAsVerified();
    event(new Verified($user));
    return view('auth.verified');
})->name('verification.verify');


Route::get('/wew', function(){
    return view('auth.verified');
    return redirect()->away("https://beehicle.xyz/welcome");
});

Route::middleware(['auth',IsAdmin::class])->group(function(){
    Route::get('/user', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
    
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/vehicles', [App\Http\Controllers\AdminController::class, 'vehicles'])->name('vehicles');
    Route::get('/services', [App\Http\Controllers\AdminController::class, 'services'])->name('services');
    Route::get('/transactions', [App\Http\Controllers\AdminController::class, 'transactions'])->name('transactions');
    Route::get('/profile',[App\Http\Controllers\AdminController::class, 'profile'])->name('profile');
    Route::post('/profile',[App\Http\Controllers\AdminController::class, 'updateProfile'])->name('profile.update');

});

Route::get('/logout', function(){
    auth()->logout();
    return redirect('/');
});
