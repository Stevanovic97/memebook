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
Route::get('/{category_id}', 'MemeController@categoryIndex')->name('filter.category');
Route::get('/memes/{user_id}', 'MemeController@userIndex')->name('filter.user');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/meme/create', 'MemeController@create')->name('meme.create');
    Route::post('/memes', 'MemeController@store')->name('meme.store');
    Route::get('/meme/delete/{id}', 'MemeController@destroy')->name('meme.delete');

    Route::get('/users/{user_id}', 'UserController@show')->name('show.user');

});


