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

//in route.php or web.php
Route::middleware('apilogger')->post('/test',function(){
    return response()->json("test");
});

Route::get('authors/create', 'AuthorsController@create')->name('create-author');
Route::get('articles/create', 'ArticlesController@create')->name('create-article');
Route::get('tags/create', 'TagsController@create')->name('create-tag');
Route::get('my-news', 'MyNewsController@show')->name('home');
Route::get('articles', 'ArticlesController@index')->name('articles');
Route::get('authors', 'AuthorsController@index')->name('authors');
Route::get('tags', 'TagsController@index')->name('tags');
Route::get('articles/{id}', 'ArticlesController@show')->name('single-article');
Route::get('authors/{id}', 'AuthorsController@show')->name('single-author');
Route::get('tags/{id}', 'TagsController@show')->name('single-tag');
Route::post('invoke', 'InvokableController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
