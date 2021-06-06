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
/* ルート情報を一括で作成
    →「php artisan route:list」でルート情報確認
**/

Route::apiResource('/photoInfo', 'PhotoInfoController');

Route::apiResource('/images', 'ImageApiController');