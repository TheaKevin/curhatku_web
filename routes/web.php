<?php

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

Route::get('/', [LoginController::class, 'home'])->name('home');
Route::post('/login/load', [LoginController::class, 'login'])->name('login');
Route::post('/register/load', [LoginController::class, 'register'])->name('register');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/email/verify', [LoginController::class, 'verify'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [LoginController::class, 'verifyEmail'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [LoginController::class, 'resendVerification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/TulisCurhat', [CurhatController::class, 'TulisCurhat'])->name('TulisCurhat')->middleware(['auth', 'verified']);
Route::post('/TulisCurhat', [CurhatController::class, 'TulisCurhatPost'])->name('TulisCurhatPost')->middleware(['auth', 'verified']);

Route::get('/Curhat/{id}', [CurhatController::class, 'Curhat'])->name('Curhat');
Route::post('/Curhat/comment', [CurhatController::class, 'Comment'])->name('Comment')->middleware(['auth', 'verified']);

Route::get('/Profile', [UserController::class, 'Profile'])->name('Profile')->middleware('auth');
Route::get('/Profile/Edit', [UserController::class, 'EditProfile'])->name('EditProfile')->middleware(['auth', 'verified']);
Route::post('/Profile/Edit', [UserController::class, 'EditProfilePost'])->name('EditProfilePost')->middleware(['auth', 'verified']);
