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

// -------共通部分-------
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('brochures')->group(function () {
    // 一覧画面
    Route::get('', [App\Http\Controllers\BrochureController::class, 'index']);
    // プレビュー画面
    Route::get('/cover/{id}', [App\Http\Controllers\BrochureController::class, 'cover']);
    // 検索機能
    Route::get('/search', [App\Http\Controllers\BrochureController::class, 'search']);
    // 承認機能
    Route::get('/consent', [App\Http\Controllers\WorkFlowController::class, 'consent']);
    // 決裁済み画面
    Route::get('/result', [App\Http\Controllers\WorkFlowController::class, 'result']);
});

// ユーザー権限設定
// 管理者のみ
Route::group(['middleware' => ['auth', 'can:admin-higher']], function () {
    Route::prefix('brochures')->group(function () {

        // -------データベース関係--------

        // 新規登録
        Route::get('/register', [App\Http\Controllers\BrochureController::class, 'register']);
        Route::post('/add', [App\Http\Controllers\BrochureController::class, 'add']);
        // 登録編集
        Route::post('/edit/{id}', [App\Http\Controllers\BrochureController::class, 'edit']);
        Route::post('/update', [App\Http\Controllers\BrochureController::class, 'update']);
        // 登録削除
        Route::post('/delete/{id}', [App\Http\Controllers\BrochureController::class, 'destroy']);

        // -------ワークフロー関係--------

        // 申請状況更新(承認or否認（差戻）)
        Route::post('/approval/{id}', [App\Http\Controllers\WorkFlowController::class, 'approval']);
        Route::post('/disapproval/{id}', [App\Http\Controllers\WorkFlowController::class, 'disapproval']);
        // 承認差戻
        Route::post('/remand/{id}', [App\Http\Controllers\WorkFlowController::class, 'remand']);

        // -------ユーザー関係-----------

        // ユーザー管理
        Route::get('/user', [App\Http\Controllers\UserController::class, 'user']);

        // -------ワークフロー関係--------
  
        // 申請状況更新(承認or否認（差戻）)
        Route::post('/approval/{id}', [App\Http\Controllers\WorkFlowController::class, 'approval']);
        Route::post('/disapproval/{id}', [App\Http\Controllers\WorkFlowController::class, 'disapproval']);
        // 承認差戻
        Route::post('/remand/{id}', [App\Http\Controllers\WorkFlowController::class, 'remand']);
    });
});

// ユーザーのみ
Route::group(['middleware' => ['auth', 'can:user-higher']], function () {
    Route::prefix('brochures')->group(function () {

        // -------ワークフロー関係--------

        // 新規申請
        Route::post('/request/{id}', [App\Http\Controllers\WorkFlowController::class, 'request']);
        Route::post('/application', [App\Http\Controllers\WorkFlowController::class, 'application']);
        // 申請削除
        Route::post('/consent/delete/{id}', [App\Http\Controllers\WorkFlowController::class, 'destroy']);
        // 申請編集
        Route::post('/consent/edit/{id}', [App\Http\Controllers\WorkFlowController::class, 'reapplication']);
        Route::post('/consent/update', [App\Http\Controllers\WorkFlowController::class, 'update']);
    });
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
