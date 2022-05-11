<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
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

////// Member //////
Route::get('/', [MemberController::class, 'index'])
    ->name('member.index');

Route::get('/member/signup', [MemberController::class, 'signup'])
    ->name('member.signup');

Route::post('/member/store', [MemberController::class, 'store'])
    ->name('member.store');

Route::get('/member/signup_confirm', [MemberController::class, 'signup_confirm'])
    ->name('member.confirm');

Route::post('/member/send', [MemberController::class, 'send'])
    ->name('member.send');

Route::get('/member/signup_completed', [MemberController::class, 'completed'])
    ->name('member.completed');


///// Login /////
Route::get('/login', [LoginController::class, 'login'])
    ->name('login');

Route::post('/login/send', [LoginController::class, 'login_send'])
    ->name('login.send');

Route::get('/logout', [LoginController::class, 'logout'])
    ->name('logout');

// パスワードリセット
// Route::get('/password', [LoginController::class, 'password'])
//     ->name('password');

// Route::post('/password/reset', [LoginController::class, 'reset'])
//     ->name('password.reset');

Route::get('/product/create', [ProductController::class, 'create'])
    ->name('product.create');
