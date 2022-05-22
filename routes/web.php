<?php

use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;

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

Route::get('/ashbee',function(){
    return 'from web';
});
Auth::routes();
Route::get('/user', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');

Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
Route::get('/vehicles', [App\Http\Controllers\AdminController::class, 'vehicles'])->name('vehicles');
Route::get('/services', [App\Http\Controllers\AdminController::class, 'services'])->name('services');
Route::get('/transactions', [App\Http\Controllers\AdminController::class, 'transactions'])->name('transactions');

Route::get('/logout', function(){
    auth()->logout();
});