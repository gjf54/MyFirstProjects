<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})
    ->name('welcome_page');

Route::get('/login', function () {
    return view('auth.login');
})
    ->name('login')
    ->middleware('check_if_auth');

Route::post('/login', [LoginController::class, 'look_for_user'])->name('login_post');

Route::get('/registration', function () {
    return view('auth.registration');
})
    ->name('registration')
    ->middleware('check_if_auth');

Route::post('/registration', [RegistrationController::class, 'reg_user'])->name('registration_post');


Route::get('/todo', [ProfileController::class, 'todo'])->name('todo');


Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile')->middleware('check_if_not_auth');
    Route::get('/info', [ProfileController::class, 'info'])->name('info');
    Route::get('/info/edit', [ProfileController::class, 'info_edit'])->name('info_edit');
    Route::post('/info/edit', [ProfileController::class, 'info_update'])->name('info_update');
    Route::get('/todo', [ProfileController::class, 'todo'])->name('todo');
    Route::get('/contribution', [ProfileController::class, 'contribution'])->name('contribution');
});

Route::get('/log_out', [ProfileController::class, 'log_out'])->name('log_out');
