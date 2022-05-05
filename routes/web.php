<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
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

Route::get('/members/signup', [MemberController::class, 'signup'])
    ->name('member.signup');

Route::post('/members/store', [MemberController::class, 'store'])
    ->name('member.store');

Route::get('/members/signup_confirm', [MemberController::class, 'signup_confirm'])
    ->name('member.confirm');

Route::get('/members/send', [MemberController::class, 'send'])
    ->name('member.send');

Route::get('/members/signup_completed', [MemberController::class, 'completed'])
    ->name('member.completed');
