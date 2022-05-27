<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin;
use App\Models\Tmpimg;
use Illuminate\Support\Facades\Storage;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('product/create/store_image', [ProductController::class, 'store_image'])
    ->name('store.image');

// 必要なかった
// Route::post('admin/product/store_image', [Admin\ProductController::class, 'store_image'])
//     ->name('admin.store.image');

// Route::get('show_image_1/{tmpimg}', function(Tmpimg $tmpimg) {
//         return response()->file(Storage::path($tmpimg->path));
//   });

// Route::get('show_image_1/{tmpimg}', [ProductController::class, 'show_image_1'])
// ->name('show.image1');
