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

Route::get('/', 'HomeController@index')->name('index');

Route::get('/i/{slug}', 'RedirectController@redirect');

Route::prefix('/urls')->group(function (){
    Route::get('/', 'UrlsController@all');
    Route::get('/stat/{id}', 'UrlsController@redirectCount');
    Route::post('/','UrlsController@save');
    Route::delete('/{id}', 'UrlsController@delete');
});
