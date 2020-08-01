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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::resource('teams', 'TeamsController');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/join/{id}', 'JoinsController@joinn');
Route::get('/join/delete/{id}', 'JoinsController@cancell');
Route::get('/tambah/{id}/{iid}', 'JoinsController@acceptt');
Route::get('/tambah/delete/{id}/{iid}', 'JoinsController@declinee');