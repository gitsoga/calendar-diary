<?php

use Illuminate\Support\Facades\Route;

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

/*
Route::get('/', 'CalendarController@top');
Route::get('new/{yearmonthday}', 'DiaryController@new')->middleware('auth');
Route::post('post', 'DiaryController@store')->middleware('auth');
Route::get('edit/{yearmonthday}', 'DiaryController@edit')->middleware('auth');
Route::post('editPost', 'DiaryController@editStore')->middleware('auth');

Route::get('404', function () {
    return view('notfound');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
 */
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
