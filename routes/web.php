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

Route::get('/posts', 'PostsController@index')->name('posts.index');


//hasOne
Route::get('/phone', 'PhonesController@index')->name('phones.index');

//belongsToMany
Route::get('/roles', 'RolesController@index')->name('roles.index');

Route::get('/roles/show', 'RolesController@show')->name('roles.show');

Route::get('/comment', 'CommentsController@index')->name('comments.index');

//collect
Route::get('/collect', 'PostsController@getAll');