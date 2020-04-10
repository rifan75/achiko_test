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

Route::post('/klasemen', 'KlasemenController@check_participant');
Route::post('/next-round', 'NextRoundController@index')->name('next-round');
Route::post('/finish-round', 'FinishRoundController@index')->name('finish-round');