<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ApiController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    // ユーザー情報編集ページ
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // ユーザー情報更新処理
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // ユーザー情報削除処理
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 商品一覧ページ
    Route::get('/item', [ItemController::class, 'index']);
    // 商品登録ページ
    Route::get('/item/add', [ItemController::class, 'showAdd']);
    // 商品登録処理
    Route::post('/item/add', [ItemController::class, 'add']);
    // 商品編集ページ
    Route::get('/item/edit/{id}', [ItemController::class, 'showEdit']);
    // 商品更新処理
    Route::post('/item/edit/{id}', [ItemController::class, 'edit']);
    // 商品削除処理
    Route::delete('/item/delete/{id}', [ItemController::class, 'delete']);
    // 在庫更新処理
    Route::post('/item/stock/{id}', [ItemController::class, 'editStock']);
    // 認証済みユーザー詳細情報ページ
    Route::get('/detail', [ItemController::class, 'detail']);
});

//認証ブロックの外に記述
Route::get('/list', [ApiController::class, 'list']);
Route::post('/create', [ApiController::class, 'create']);
Route::get('/token', [ApiController::class, 'token']);


require __DIR__.'/auth.php';
