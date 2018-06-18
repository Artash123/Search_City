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
//
//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/','IndexController@index');
Route::post('search_city','CityController@index');
Route::get('search_city','CityController@index');
Route::post('city_autocomplate','CityController@autocomplate');
Route::get('city_autocomplate','CityController@autocomplate');
Route::post('get_near_cities','CityController@get_near_cities');
Route::get('get_near_cities','CityController@get_near_cities');

