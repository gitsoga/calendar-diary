<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/showCalendar/{year_month?}', Api\ShowCalendar::class);
Route::get('/edit/{id}', Api\EditDiary::class);
Route::post('/create', Api\CreatePostDiary::class);
Route::post('/edit/{id}', Api\EditPostDiary::class);
