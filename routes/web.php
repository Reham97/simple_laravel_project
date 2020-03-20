<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@index' );
Route::get('/about', 'PagesController@about' );
Route::get('/services', 'PagesController@services' );
Route::resource('posts','PostsController');

/*
Route::get('/posts','PostsController@index')->name('posts.index');
Route::get('/posts/create','PostsController@create')->name('posts.create');
Route::get('/posts/{id}','PostsController@show')->name('posts.show');
Route::post('/posts','PostsController@store')->name('posts.store');
Route::get('/posts/{id}/edit','PostsController@edit')->name('posts.edit');
Route::put('/posts/{id}','PostsController@update')->name('posts.update');
Route::delete('/posts/{id}','PostsController@destroy')->name('posts.destroy');

*/

// Route::get('/posts/{id}/{author}', function ($id, $author) {
//     return " id ". $id . '  author  ' . $author ;
// });

Auth::routes();

Route::get('/home', 'PostsController@index')->name('home');
