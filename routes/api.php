<?php

use Illuminate\Http\Request;
use App\PhotoInfo;
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
/*
--photo_infosの一覧表示
return json形式のphoto_infosテーブルのデータ
*/



// Route::apiResource('/store', 'PhotoInfoController');
// Route::apiResource('/photoInfo/register', 'PhotoInfoController');
// MEMO:完全な名前空間で指定しないとcontrollerないよーって怒られた
Route::get('/photoInfo', [App\Http\Controllers\PhotoInfoController::class, 'index']);
Route::post('/photoInfo', [App\Http\Controllers\PhotoInfoController::class, 'store']);