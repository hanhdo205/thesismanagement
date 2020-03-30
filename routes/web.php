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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
	Route::resource('roles', 'RoleController');
	Route::resource('users', 'UserController');
	Route::resource('topics', 'TopicController');
	Route::resource('esays', 'EsayController');
});

Route::get('/academic', function () {
	return view('academic');
});

Route::get('/abstract', function () {
	return view('abstract');
});

Route::get('/review', function () {
	return view('review');
});

Route::post('/review/request', function () {
	return view('review.request');
});

Route::post('/review/confirmation', function () {
	return view('review.confirmation');
});

Route::post('/review/detail', function () {
	return view('review.detail');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
