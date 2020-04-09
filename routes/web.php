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

Route::get('/endai_teisyutu/{id}', 'EssayController@createEssay')->name('topic.endai_teisyutu');
Route::post('/endai_teisyutu/register', 'EssayController@storeEssay')->name('register.endai_teisyutu');
Route::get('/request/confirm/{review_token}', 'OpponentController@requestConfirmation');
Route::post('/request/confirmed', 'OpponentController@requestReply')->name('request.reply');
Route::get('/essay-list', 'EssayController@essayList');
Route::post('/essay-ajax', 'EssayController@essayAjaxList');
Route::post('/essay-csv', 'EssayController@export');
Route::get('/opponent-list', 'OpponentController@opponentList');
Route::post('/opponent-ajax', 'OpponentController@opponentAjaxList');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/essays', 'EssayController@index');
	Route::post('/review/request', 'EssayController@reviewRequest')->name('review.request');

	Route::resource('roles', 'RoleController');
	Route::resource('users', 'UserController');
	Route::resource('topics', 'TopicController');
	Route::post('import_csv', 'ImExController@import')->name('import_csv');
	Route::post('create-new-opponent', 'UserController@register');
	Route::get('/opponents', 'OpponentController@index')->name('opponents');
	Route::post('/opponents/confirmation', 'OpponentController@confirmation')->name('opponents.confirmation');
	Route::post('/opponents/send', 'OpponentController@sendMail')->name('opponents.sendmail');
	Route::post('/review/send', 'EssayController@sendMail')->name('review.sendmail');
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

Route::post('/review/confirmation', function () {
	return view('review.confirmation');
});

Route::post('/review/detail', function () {
	return view('review.detail');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
