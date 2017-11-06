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

/**middleware ensures that user is logged in before accesssing data */
Route::get('/post', 'PostController@index')->middleware('auth');
Route::post('/post', 'PostController@store')->middleware('auth');

/**sharable link , so that user can fwd it and a freid can see
 * it without signing in
 */
Route::get('/post/{id}', 'PostController@show')->name('post.show');


Route::get('/category', 'CategoryController@index')->middleware('auth');
Route::post('/category', 'CategoryController@store')->middleware('auth');
Route::get('/post/category/{name}', 'CategoryController@showAll')->name('category.listAll')->middleware('auth');



