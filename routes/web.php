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

Route::get('/', 'MemeController@index')->name('memes.index');
Route::get('/categories/{category_id}', 'MemeController@categoryIndex')->name('filter.category');

Route::group(['middleware' => 'auth'], function () {
    //meme routes
    Route::get('/meme/create', 'MemeController@create')->name('meme.create');
    Route::post('/meme/store', 'MemeController@store')->name('meme.store');
    Route::get('/meme/edit/{meme_id}', 'MemeController@edit')->name('meme.edit');
    Route::post('/meme/delete', 'MemeController@deleteMeme')->name('meme.delete');
    Route::post('/meme/vote', 'MemeController@vote');
    Route::get('/meme/single/{id}', 'MemeController@singleMeme')->name('meme.single');
    Route::post('/meme/report', 'MemeController@reportMeme')->name('meme.report');

    //user routes
    Route::get('/users/{user_id}', 'UserController@show')->name('user.show');
    //user-edit-routes
    //photo edit
    ///////
    //name edit
    Route::get('/user/editName', 'UserController@editName')->name('user.editName');
    Route::post('/user/updateName', 'UserController@updateName')->name('user.updateName');
    //password edit
    Route::get('/user/editPassword', 'UserController@editPassword')->name('user.editPassword');
    Route::post('user/updatePassword', 'UserController@updatePassword')->name('user.updatePassword');

    Route::post('/users/follow', 'UserController@follow')->name('follow');
    Route::post('/users/unfollow', 'UserController@unfollow')->name('unfollow');
    Route::post('/user/follows', 'UserController@isFollowing')->name('follows');
    Route::get('/user/notifications', 'UserController@notifications')->name('notifications');
    Route::post('/user/notification/read', 'UserController@readNotification')->name('read.notification');
    //showing followers
    Route::get('/user/followers', 'UserController@showFollowers')->name('user.followers');
    Route::get('/user/following', 'UserController@showFollowing')->name('user.following');
});

Route::fallback(function () {
    return view("errors.404");
});

