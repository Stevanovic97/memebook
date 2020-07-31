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
Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'MemeController@index')->name('memes.index');
Route::get('/memes/create', 'MemeController@create')->name('memes.create');
Route::post('/memes', 'MemeController@store')->name('memes.store');
Route::get('/memes/{id}', 'MemeController@destroy')->name('memes.destroy');

//Route::delete('/memes/{id}', 'MemeController@destroy')->name('memes.destroy');

//Route::resource('memes', 'MemeController', ['except' => ['show']]);

