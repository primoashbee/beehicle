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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('index');

Route::get('/logout', function(){
    auth()->logout();
});