<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Models\Tmpimg;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;

Route::prefix('admin')->group(function() {
    Route::get('login', [Admin\LoginController::class, 'index'])->name('admin.login.index');
    Route::post('login', [Admin\LoginController::class, 'login'])->name('admin.login.login');
    Route::get('logout', [Admin\LoginController::class, 'logout'])->name('admin.login.logout');
    Route::get('/', [Admin\IndexController::class, 'index'])->name('admin.index');

});

