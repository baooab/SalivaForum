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

Route::view('/v2/blog', 'v2.blog');

/**
 * 网站首页
 */

Route::group(['namespace' => 'Forum'], function () {

    Route::get('/', 'DiscussionController@overview')->name('overview');

});


/**
 * 认证系统
 */

Route::group(['namespace' => 'Auth'], function () {

    // Session
    Route::get('login', ['as' => 'login', 'uses' => 'LoginController@showLoginForm']);
    Route::post('login', ['as' => 'login.post', 'uses' => 'LoginController@login']);
    Route::get('logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

    // 注册
    Route::get('register', ['as' => 'register', 'uses' => 'RegisterController@showRegistrationForm']);
    Route::post('register', ['as' => 'register.post', 'uses' => 'RegisterController@register']);

    // 密码重置
    Route::get('password/reset', ['as' => 'password.forgot', 'uses' => 'ForgotPasswordController@showLinkRequestForm']);
    Route::post('password/email', ['as' => 'password.forgot.post', 'uses' => 'ForgotPasswordController@sendResetLinkEmail']);
    Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'ResetPasswordController@showResetForm']);
    Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'ResetPasswordController@reset']);

    // Email 地址验证
    Route::get('email-confirmation', ['as' => 'email.send_confirmation', 'uses' => 'EmailConfirmationController@send']);
    Route::get('email-confirmation/{email_address}/{code}', ['as' => 'email.confirm', 'uses' => 'EmailConfirmationController@confirm']);

});


/**
 * 论坛
 */

Route::group(['prefix' => 'discussion', 'namespace' => 'Forum'], function () {

    // 首页

    Route::get('/', 'DiscussionController@overview')
        ->name('forum');

    // 评论

    Route::post('create-comment', 'CommentController@store')
        ->name('comments.store');

    // 帖子

    Route::get('create-discussion', 'DiscussionController@create')
        ->name('discussions.create');
    Route::post('create-discussion', 'DiscussionController@store')
        ->name('discussions.store');

    Route::get('{discussion}', 'DiscussionController@show')
        ->name('discussion');
    Route::get('{discussion}/edit', 'DiscussionController@edit')
        ->name('discussions.edit');
    Route::match(['put', 'patch'], '/', 'DiscussionController@update')
        ->name('discussions.update');
});


/**
 * 用户
 */

Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@show']);
Route::get('user/{username}', ['as' => 'profile', 'uses' => 'ProfileController@show']);
Route::get('user/{username}/discussions', ['as' => 'profile.discussions', 'uses' => 'ProfileController@discussions']);


/**
 * 设置
 */

Route::get('settings', ['as' => 'settings.profile', 'uses' => 'Settings\ProfileController@edit']);
Route::put('settings', ['as' => 'settings.profile.update', 'uses' => 'Settings\ProfileController@update']);
Route::get('settings/avatar', ['as' => 'settings.avatar', 'uses' => 'Settings\AvatarController@edit']);
Route::put('settings/avatar', ['as' => 'settings.avatar.update', 'uses' => 'Settings\AvatarController@update']);
Route::get('settings/password', ['as' => 'settings.password', 'uses' => 'Settings\PasswordController@edit']);
Route::put('settings/password', ['as' => 'settings.password.update', 'uses' => 'Settings\PasswordController@update']);

/**
 * 搜索
 */

Route::get('search', ['as' => 'search.enter', 'uses' => 'SearchController@enter']);

/**
 * 采集
 */

Route::group(['prefix' => 'collection', 'namespace' => 'Collection'], function () {

    Route::get('/', 'CollectionController@overview')
        ->name('collection.overview');
    Route::get('create', 'CollectionController@create')
        ->name('collection.create');
    Route::post('store', 'CollectionController@store')
        ->name('collection.store');

});
