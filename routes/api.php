<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'apilogger'], function(){
    Route::get('articles', 'ArticlesController@index');
    Route::post('articles', 'ArticlesController@store');
    Route::put('articles', 'ArticlesController@store');
    Route::get('authors', 'AuthorsController@index')->name('authors');
    Route::post('authors', 'AuthorsController@store');
    Route::put('authors', 'AuthorsController@store');    
    Route::get('articles/{id}', 'ArticlesController@show');
    Route::delete('articles/{id}', 'ArticlesController@destroy');   
    Route::delete('authors/{id}', 'AuthorsController@destroy');
});
