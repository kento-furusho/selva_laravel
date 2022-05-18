<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Models\Tmpimg;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;
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

Route::get('/member/show', [MemberController::class, 'show'])
    ->name('member.show')->middleware('auth');

Route::get('/member/delete_confirm', [MemberController::class, 'delete_confirm'])
    ->name('member.delete.confirm')->middleware('auth');

Route::get('/member/delete', function() {
        Member::find(auth()->user()->id)->delete();
        return redirect()->route('member.index');
})->name('member.delete');

// 会員情報変更
Route::get('/member/edit/profile', [MemberController::class, 'editProfile'])
    ->name('edit.profile');

Route::post('/member/edit/profile/store', [MemberController::class, 'storeEditProfile'])
    ->name('store.edit.profile');

Route::get('/member/edit/profile/confirm', [MemberController::class, 'confirmEditProfile'])
    ->name('confirm.edit.profile');

Route::post('/member/edit/profile/send', [MemberController::class, 'sendEditProfile'])
    ->name('send.edit.profile');

// パスワード変更
Route::get('/member/edit/password', function() {
    return view('member.edit.password');
})->name('edit.password');

Route::post('/member/edit/password/store', [MemberController::class, 'storeEditPassword'])
    ->name('store.edit.password');

// メアド変更
Route::get('/member/edit/email', function() {
    return view('member.edit.email');
})->name('edit.email');

Route::post('/member/edit/email/store', [MemberController::class, 'storeEditEmail'])
    ->name('store.edit.email');

Route::get('/member/edit/email/confirm', function() {
    return view('member.edit.confirm_email');
})->name('confirm.edit.email');

Route::post('/member/edit/email/send', [MemberController::class, 'sendEditEmail'])
    ->name('send.edit.email');

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
    ->name('product.create')->middleware('auth');

Route::get('/product/back', [ProductController::class, 'back_page'])
    ->name('product.back');

Route::get('/product/create/get_subcategory/{category_id}', [ProductController::class, 'get_subcategory'])
    ->name('get_subcategory');

Route::post('/product/create/store', [ProductController::class, 'product_store'])
    ->name('product.store');

Route::get('/product/create/confirm', [ProductController::class, 'product_confirm'])
    ->name('product.confirm');

Route::post('/product/create/send', [ProductController::class, 'product_send'])
    ->name('product.send');


// Route::post('/product/create/store_image', [ProductController::class, 'store_image'])
//     ->name('store.image');

// Route::get('/product/confirm', [ProductController::class, 'product_confirm'])
//     ->name('product.confirm');

// 画像表示
Route::get('/product/show_image/{tmpimg}',function(Tmpimg $tmpimg) {
      return response()->file(Storage::path($tmpimg->path));
});

// 商品検索
Route::get('/product/search/top', [ProductController::class, 'search_index'])
    ->name('search.index');

Route::any('/product/search', [ProductController::class, 'search'])
    ->name('product.search');

// 商品詳細
Route::get('/product/{product}', [ProductController::class, 'show'])
    ->name('product.show');

//レビュー
Route::get('/review/{product}/create', [ReviewController::class, 'create'])
    ->name('review.create')->middleware('auth');;

Route::post('/review/{product}/store', [ReviewController::class, 'store'])
    ->name('review.store');

Route::post('/review/send', [ReviewController::class, 'send'])
    ->name('review.send');

Route::get('/review/complete', [ReviewController::class, 'complete'])
    ->name('review.complete');

Route::any('/review/show', [ReviewController::class, 'show'])
    ->name('review.show');

