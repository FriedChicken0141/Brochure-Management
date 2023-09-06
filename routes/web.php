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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('brochures')->group(function () {
    // 一覧画面
    Route::get('', [App\Http\Controllers\brochureController::class, 'index']);
    // 登録画面
    Route::get('/register', [App\Http\Controllers\brochureController::class, 'register']);
    Route::post('/add', [App\Http\Controllers\brochureController::class, 'add']);
    // 編集画面
    Route::post('/edit/{id}', [App\Http\Controllers\brochureController::class, 'edit']);
    Route::post('/update', [App\Http\Controllers\brochureController::class, 'update']);
    // 削除画面
    Route::post('/delete/{id}', [App\Http\Controllers\brochureController::class, 'destroy']);
    // 検索機能
    Route::get('/search', [App\Http\Controllers\brochureController::class, 'search']);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
