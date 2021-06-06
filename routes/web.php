<?php

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

Route::get('/', 'HomeController@index')->name('customer');

// 2021/06/06 ログアウト機能実装
Route::get('/logout', 'Auth\LoginController@logout');

// 2021/05/16 リロード時、404エラー対応処理 start
Route::get('/place', function () {
    return view('customer');
});

Route::get('/admin', function () {
    return view('customer');
});

Route::get('/photo-display', function () {
    return view('customer');
});
// 2021/05/16 リロード時、404エラー対応処理 end

Auth::routes();
