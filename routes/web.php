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



Route::get('/','PagesController@welcome');

Route::get('/news', 'PagesController@news');

Route::get('/news-post/{id}/{title}', 'PagesController@singlePostNews');

Route::post('/contact' , 'ContactController@create');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::any('{any?}', 'AdminController@index')->where('any' , '.*')->middleware('auth');
