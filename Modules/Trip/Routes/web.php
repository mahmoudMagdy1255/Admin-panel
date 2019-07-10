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
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

	Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {

		Route::delete('/trip-photos/delete/{id}', 'TripsController@deletePic');
		Route::post('/trip-photos', 'TripsController@storeAlbum');

		Route::resource('/trip-categories', 'TripCategoriesController');

		Route::resource('/trips', 'TripsController');

		Route::resource('/destinations', 'DestinationController');

		Route::resource('/trip-programs', 'TripProgramController');

	});

});
