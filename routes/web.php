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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('Pages.about');
});

Route::get('/services', function () {
    return view('Pages.services');
});

// Route::get('/posts/{id}/{author}', function ($id, $author) {
//     return " id ". $id . '  author  ' . $author ;
// });
