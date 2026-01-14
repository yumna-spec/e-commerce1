<?php
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;

use Illuminate\Support\Facades\Route; //
Route::get('/login', [UserController::class, 'showLogin'])->name('login.form')->middleware('guest:web');
Route::get('/register', [UserController::class, 'showRegister'])->name('register.form')->middleware('guest:web');


Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');


  Route::get('/Admin/login', [AdminController::class, 'showLogin'])
        ->name('admin.login')
        ->middleware('guest:admin');

    Route::post('/Admin/login', [AdminController::class, 'login'])
        ->name('admin.login.submit')
        ->middleware('guest:admin');

    Route::post('/admin/logout', [AdminController::class, 'Adminlogout'])->name('admin.logout');