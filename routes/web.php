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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/threads', 'ThreadsController@store')->name('threads.store');
Route::get('/threads/create', 'ThreadsController@create')->name('threads.create');
Route::post('/threads/{thread}/replies', 'RepliesController@store')->name('replies.store');
Route::get('/channels/{channel}/threads/{thread}', 'ThreadsController@show')->name('threads.show');
Route::get('/threads', 'ThreadsController@index')->name('threads.index');
Route::get('/channels/{channel?}', 'ChannelController@index')->name('channels.index');

Route::post('/channels/{channel}/threads/{thread}/replies', 'RepliesController@store')->name('replies.store');
