<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;

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


Route::get('/test', function () {
    return view('pages.dashboard', [
        'title' => "Test"
    ]);
});

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login.index');    
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});


Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->except(['show', 'create', 'edit']);
    Route::resource('students', StudentController::class)->except(['show', 'create', 'edit']);
});
