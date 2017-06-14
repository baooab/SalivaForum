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

Route::get('/', 'DiscussionController@home')->name('home');
Route::resource('discussions', 'DiscussionController');
Route::resource('comments', 'CommentController');

// Auth::routes();

Route::get('login', 'UserController@login')->name('login');
Route::post('login', 'UserController@signin');
Route::get('register', 'UserController@register')->name('register');
Route::post('register', 'UserController@store');
Route::post('logout', 'UserController@logout')->name('logout');
Route::get('verify/{confirm_code}', 'UserController@confirm')->name('verify');

Route::get('user/avatar', 'UserController@getAvatar')->name('show.avatar');
Route::post('user/avatar', 'UserController@changeAvatar')->name('update.avatar');
