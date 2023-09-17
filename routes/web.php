<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// 共通部分
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('brochures')->group(function () {
    // 一覧画面
    Route::get('', [App\Http\Controllers\brochureController::class, 'index']);
    // プレビュー画面
    Route::get('/cover/{id}', [App\Http\Controllers\brochureController::class, 'cover']);
    // 検索機能
    Route::get('/search', [App\Http\Controllers\brochureController::class, 'search']);
});

// ユーザー権限設定
// 管理者のみ
Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {
    Route::prefix('brochures')->group(function () {
        // 登録画面
        Route::get('/register', [App\Http\Controllers\brochureController::class, 'register']);
        Route::post('/add', [App\Http\Controllers\brochureController::class, 'add']);
        // 編集画面
        Route::post('/edit/{id}', [App\Http\Controllers\brochureController::class, 'edit']);
        Route::post('/update', [App\Http\Controllers\brochureController::class, 'update']);
        // 削除画面
        Route::post('/delete/{id}', [App\Http\Controllers\brochureController::class, 'destroy']);
    });
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
