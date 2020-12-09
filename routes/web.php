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

Route::get('/', 'CalendarController@top');
Route::get('calendar/{yearmonth}', 'CalendarController@show');
Route::get('new/{yearmonthday}', 'DiaryController@new');
Route::post('post', 'DiaryController@store');

Route::get('404', function () {
    return view('notfound');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
