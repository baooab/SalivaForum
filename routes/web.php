<?php

use App\Link;
use Illuminate\Http\Request;

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

// 登录、注册

Route::get('login', 'UserController@login')->name('login');
Route::post('login', 'UserController@signin');
Route::get('register', 'UserController@register')->name('register');
Route::post('register', 'UserController@store');
Route::post('logout', 'UserController@logout')->name('logout');
Route::get('verify/{confirm_code}', 'UserController@confirm')->name('verify');

Route::get('user/avatar', 'UserController@getAvatar')->name('show.avatar');
Route::post('user/avatar', 'UserController@changeAvatar')->name('update.avatar');

// 帖子功能

Route::get('/', 'DiscussionController@home')->name('home');
Route::resource('discussions', 'DiscussionController');
Route::resource('comments', 'CommentController');
Route::get('user/{id}/discussions', 'UserController@discussions')->name('user.discussions');

// 采集功能

Route::group(['prefix' => 'links'], function () {
    Route::get('', function () {
        $links = Link::with('user')->latest()->paginate(50);
        return view('links.index', compact('links'));
    });
    Route::get('create', function () {
        return view('links.create');
    })->middleware('auth');
    Route::post('store', function(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'url' => 'required|max:255',
            'description' => 'present|max:255',
        ]);
        if ($validator->fails()) {
            return back()
                ->withInput()
                ->withErrors($validator);
        }
        $link = new Link();
        $link->user_id = Auth::user()->id;
        $link->title = $request->title;
        $link->url = $request->url;
        $link->description = $request->description;
        $link->save();
        return redirect('/links');
    })->middleware('auth');
});
