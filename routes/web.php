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

LaravelGettext::setLocale('ja_JP');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	Route::get('/', 'HomeController@index')->name('home');
	Route::resource('roles', 'RoleController');
	Route::resource('users', 'UserController');
	Route::resource('opponents', 'OpponentController');
	Route::resource('topics', 'TopicController');
	Route::resource('esays', 'EsayController');
	Route::get('export', 'ImExController@export')->name('export');
	Route::get('importExportView', 'ImExController@importExportView');
	Route::post('import', 'ImExController@import')->name('import');
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
