<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Models\Tmpimg;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin;
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

Route::post('/member/edit/profile/store', [MemberController::class, 'validateEditProfile'])
    ->name('validate.edit.profile');

Route::get('/member/edit/profile/confirm', [MemberController::class, 'confirmEditProfile'])
    ->name('confirm.edit.profile');

Route::post('/member/edit/profile/send', [MemberController::class, 'sendEditProfile'])
    ->name('send.edit.profile');

// パスワード変更
Route::get('/member/edit/password', function() {
    return view('member.edit.password');
})->name('edit.password');

Route::post('/member/edit/password/validate', [MemberController::class, 'validateEditPassword'])
    ->name('validate.edit.password');

// メアド変更
Route::get('/member/edit/email', function() {
    return view('member.edit.email');
})->name('edit.email');

Route::post('/member/edit/email/validate', [MemberController::class, 'validateEditEmail'])
    ->name('validate.edit.email');

Route::get('/member/edit/email/confirm', function() {
    return view('member.edit.confirm_email');
})->name('confirm.edit.email');

Route::post('/member/edit/email/send', [MemberController::class, 'sendEditEmail'])
    ->name('send.edit.email');

// レビュー編集
// レビュー管理画面
Route::get('member/reviews', [ReviewController::class, 'memberReviews'])
    ->name('member.reviews');

Route::get('/review/{review}/update', [ReviewController::class, 'reviewUpdate'])
    ->name('review.update');

Route::post('/review/{review}/update/validate', [ReviewController::class, 'validateUpdate'])
    ->name('review.update.validate');

Route::post('/review/update/send', [ReviewController::class, 'sendUpdate'])
    ->name('review.update.send');

Route::get('/review/{review}/delete', [ReviewController::class, 'delete'])
    ->name('review.delete');

Route::get('/review/{review}/delete/send', [ReviewController::class, 'sendDelete'])
    ->name('review.delete.send');

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
    ->name('review.create')->middleware('auth');

Route::post('/review/{product}/store', [ReviewController::class, 'store'])
    ->name('review.store');

Route::post('/review/send', [ReviewController::class, 'send'])
    ->name('review.send');

Route::get('/review/complete', [ReviewController::class, 'complete'])
    ->name('review.complete');

Route::any('/review/show', [ReviewController::class, 'show'])
    ->name('review.show');

// 管理
// Route::get('admin/login', [Admin\LoginController::class, 'index'])->name('admin.login.index');

// Route::post('admin/login', [Admin\LoginController::class, 'login'])->name('admin.login.index');

// Route::get('admin/logout', [Admin\LoginController::class, 'logout'])->name('admin.login.index');

// Route::get('admin/', [Admin\IndexController::class, 'index'])->name('admin.index')->middleware('auth:administers');

Route::prefix('admin')->group(function() {
    Route::get('login', [Admin\LoginController::class, 'index'])->name('admin.login.index');
    Route::post('login', [Admin\LoginController::class, 'login'])->name('admin.login.login');
    Route::get('logout', [Admin\LoginController::class, 'logout'])->name('admin.login.logout');
});
// Route::prefix('admin')->middleware('auth.admins:administers')->group(function() {
//     Route::get('/', [Admin\IndexController::class, 'index'])->name('admin.index');
// });

Route::get('/admin', [Admin\IndexController::class, 'index'])
    ->name('admin.index')->middleware('auth.admins:administers');

// 会員一覧
Route::get('/admin/member', [Admin\MemberController::class, 'index'])
    ->name('admin.member')->middleware('auth.admins:administers');
Route::get('/admin/member/search', [Admin\MemberController::class, 'search'])
    ->name('admin.member.search')->middleware('auth.admins:administers');
Route::get('/admin/member/search/order_desc', [Admin\MemberController::class, 'orderDesc'])
    ->name('admin.member.order_desc');
Route::get('/admin/member/search/order_asc', [Admin\MemberController::class, 'orderAsc'])
    ->name('admin.member.order_asc');
Route::get('/admin/member/create', [Admin\MemberController::class, 'create'])
    ->name('admin.member.create');
Route::get('/admin/member/{member}/edit', [Admin\MemberController::class, 'edit'])
    ->name('admin.member.edit');
Route::post('/admin/member/create/store', [Admin\MemberController::class, 'createStore'])
    ->name('admin.member.create.store');
Route::post('/admin/member/edit/{member}/store', [Admin\MemberController::class, 'editStore'])
    ->name('admin.member.edit.store');
Route::post('/admin/member/create/send', [Admin\MemberController::class, 'createSend'])
    ->name('admin.member.create.send');
Route::post('/admin/member/edit/{member}/send', [Admin\MemberController::class, 'editSend'])
    ->name('admin.member.edit.send');
Route::get('/admin/member/show/{member}', [Admin\MemberController::class, 'show'])
    ->name('admin.member.show');
Route::get('/admin/member/{member}/delete', [Admin\MemberController::class, 'delete'])
    ->name('admin.member.delete');
// カテゴリー一覧
Route::get('/admin/category', [Admin\CategoryController::class, 'index'])
    ->name('admin.category')->middleware('auth.admins:administers');
Route::get('/admin/category/search', [Admin\CategoryController::class, 'search'])
    ->name('admin.category.search')->middleware('auth.admins:administers');
Route::get('/admin/category/search/order_desc', [Admin\CategoryController::class, 'orderDesc'])
    ->name('admin.category.order_desc');
Route::get('/admin/category/search/order_asc', [Admin\CategoryController::class, 'orderAsc'])
    ->name('admin.category.order_asc');
Route::get('/admin/category/create', [Admin\CategoryController::class, 'create'])
    ->name('admin.category.create');
Route::get('/admin/category/{product_category}/edit', [Admin\CategoryController::class, 'edit'])
    ->name('admin.category.edit');
Route::post('/admin/category/create/store', [Admin\CategoryController::class, 'createStore'])
    ->name('admin.category.create.store');
Route::post('/admin/category/edit/{product_category}/store', [Admin\CategoryController::class, 'editStore'])
    ->name('admin.category.edit.store');
Route::post('/admin/category/create/send', [Admin\CategoryController::class, 'createSend'])
    ->name('admin.category.create.send');
Route::post('/admin/category/edit/{product_category}/send', [Admin\CategoryController::class, 'editSend'])
    ->name('admin.category.edit.send');
