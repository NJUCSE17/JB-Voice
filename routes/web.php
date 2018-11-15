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

Auth::routes();

Route::get('/', 'HomeController@index')->name('activity');
Route::get('/activity/{id}', 'ActivityController@index')->name('activity');
Route::post('/activity/{id}/comment', 'ActivityController@comment')->name('activity.comment');
