<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

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

// お問い合わせフォーム
// お問い合わせフォーム入力画面の表示
Route::get('/', [ContactController::class, 'index']);

// お問い合わせフォーム確認画面の表示
Route::post('/confirm', [ContactController::class, 'confirm']);

// Thanksページの表示
Route::post('/thanks', [ContactController::class, 'store']);


// 管理画面の表示
Route::middleware('auth')->group(function() {
    Route::get('/admin', [AuthController::class, 'index']);
});

// Admin画面の検索機能
Route::get('/admin/search', [AuthController::class, 'search']);