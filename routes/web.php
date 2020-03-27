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
    return view('home');
});

Route::get('/academic', function () {
    return view('academic');
});

Route::get('/abstract', function () {
    return view('abstract');
});

Route::post('/abstract/detail', function () {
    return view('abstract.detail');
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