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

Route::get('/home', 'PostController@index')->middleware('auth');

/**middleware ensures that user is logged in before accesssing data */
Route::get('/post', 'PostController@index')->middleware('auth');
Route::post('/post', 'PostController@store')->middleware('auth');



