<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminTopController;
use App\Http\Controllers\admin\AdminLogoutController;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\ManageUserController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(["register" => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// 管理側
Route::group(['middleware' => ['auth.admin']], function() {

    // 管理側トップ
    Route::get('/admin', [AdminTopController::class, 'show']);
    // ログアウト実行
    Route::post('/admin/logout', [AdminLogoutController::class, 'logout']);
    // ユーザー一覧
    Route::get('/admin/user_list', [ManageUserController::class, 'showUserList']);

    // ユーザー登録
    Route::get('/admin/user/create', [ManageUserController::class, 'showUserCreateForm']);
    Route::post('/admin/user/create', [ManageUserController::class, 'create']);

    // ユーザー詳細
    Route::get('/admin/user/{id}', [ManageUserController::class, 'showUserDetail']);
    Route::post('/admin/user/{id}', [ManageUserController::class, 'update']);
});

// 管理側ログイン
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm']);
Route::post('/admin/login', [AdminLoginController::class, 'login']);
