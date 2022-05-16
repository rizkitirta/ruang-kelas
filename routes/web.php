<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthController\LoginController;
use App\Http\Controllers\AuthController\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\TugasController;
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

Route::get('/', function () {
    return \Redirect::route('dashboard.index');
});

// Authentication
Route::group(['prefix' => 'auth'], function () {

    // Register
    Route::group(['prefix' => 'register', 'as' => 'register.'], function () {
        Route::get('/', [RegisterController::class, 'index'])->name('index');
        Route::post('/store', [RegisterController::class, 'register'])->name('store');
    });

    // Login
    Route::group(['prefix' => 'login', 'as' => 'login.'], function () {
        Route::get('/', [LoginController::class, 'index'])->name('index');
        Route::post('/store', [LoginController::class, 'login'])->name('store');
    });

    Route::get('/logout', function () {
        \Auth::logout();
        return \Redirect::route('login.index');
    })->name('logout');
});

// Dashboard
Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

    // Kelas
    Route::group(['prefix' => 'kelas', 'as' => 'kelas.'], function () {
        Route::get('/tambah', [KelasController::class, 'create'])->name('tambah');
        Route::post('/store', [KelasController::class, 'store'])->name('store');
        Route::get('/detail/{id}', [KelasController::class, 'show'])->name('detail');
    });
    // Tugas
    Route::group(['prefix' => 'tugas', 'as' => 'tugas.'], function () {
        Route::get('/tambah', [TugasController::class, 'create'])->name('tambah');
        Route::post('/store', [TugasController::class, 'store'])->name('store');
    });
});
