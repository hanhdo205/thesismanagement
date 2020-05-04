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

//Auth::routes();
Auth::routes(['register' => false]);

Route::get('/endai_teisyutu/{id}', 'EssayController@create')->name('topic.endai_teisyutu');
Route::post('/endai_teisyutu/register', 'EssayController@store')->name('register.endai_teisyutu');
Route::get('/review/{id}/{token}', 'EssayController@review')->name('essays.review');
Route::get('/request/confirm/{review_token}', 'OpponentController@requestConfirmation');
Route::post('/request/confirmed', 'OpponentController@requestReply')->name('request.reply');
Route::resource('essays', 'EssayController')->only([
	'create', 'store', 'update',
]);

Route::get('/storage/essays/{file_name}', function ($file_name = null) {
	$file = public_path() . '/essays/' . $file_name;
	$headers = array(
		'Content-Type: application/octet-stream',
	);
	if (Storage::exists('/essays/' . $file_name)) {
		return Response::download($file, $file_name, $headers);
	}
	return abort(404);
});

Route::get('/storage/{file_name}', function ($file_name = null) {
	$filePath = public_path() . '/sample.csv';
	$fileContent = Storage::get($filePath);
	$response = response($fileContent, 200, [
		'Content-Type' => 'application/octet-stream',
		'Content-Disposition' => 'attachment; filename="' . $file_name . '"',
	]);
	return $response;
});

Route::group(['middleware' => ['auth']], function () {

	Route::get('/', 'HomeController@index')->name('home');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::post('/opponents/confirmation', 'OpponentController@confirmation')->name('opponents.confirmation');
	Route::post('/opponents/send', 'OpponentController@sendMail')->name('opponents.sendmail');
	Route::post('/opponents/check', 'OpponentController@isWaiting')->name('opponents.check');
	Route::post('/essays-export', 'EssayController@export')->name('essays.export');
	Route::post('/review/request', 'EssayController@reviewRequest')->name('review.request');
	Route::get('/submiter', 'EssayController@submiterList')->name('essays.submiter');
	Route::post('/import_csv', 'ImExController@import')->name('import_csv');
	Route::post('/create-new-opponent', 'UserController@register');
	Route::get('/users/profile', 'UserController@profile')->name('users.profile');

	Route::post('/review/send', 'EssayController@sendMail')->name('review.sendmail');
	Route::post('/review/check', 'EssayController@isReview')->name('review.check');

	//Route::resource('roles', 'RoleController')->except(['update']);
	Route::resource('users', 'UserController')->only(['update']);
	Route::resource('topics', 'TopicController');
	Route::resource('opponents', 'OpponentController')->only(['index']);
	Route::resource('essays', 'EssayController')->only([
		'index', 'edit',
	]);
});
