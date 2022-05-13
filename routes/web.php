<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Auth\LoginController;
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
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');

Route::post('login', 'Auth\LoginController@login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// パスワードリセット
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')
    ->name('password.request');

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')
    ->name('password.email');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');

Route::post('password/reset', 'Auth\ResetPasswordController@reset')
    ->name('password.update');

// 商品登録
Route::get('/product/create', [ProductController::class, 'create'])
    ->name('product.create');

Route::get('/product/create/get_subcategory/{category_id}', [ProductController::class, 'get_subcategory'])
    ->name('get_subcategory');

Route::post('/product/create/store_image', [ProductController::class, 'store_image'])
    ->name('store.image');

Route::get('/product/confirm', [ProductController::class, 'product_confirm'])
    ->name('product.confirm');

