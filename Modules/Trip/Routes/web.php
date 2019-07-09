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

Route::group(['prefix' => 'admin-panel', 'middleware' => ['auth:admin']], function(){

    Route::get('/trip/category/ajax', 'TripCategoryController@dataTables');

    Route::get('/trip/ajax', 'TripController@dataTables');

    Route::delete('/trip-photos/delete/{id}', 'TripController@deletePic');
    Route::post('/trip-photos', 'TripController@storeAlbum');

    // Route::get('/trip/photos/ajax/{id}', 'TripController@photoDataTable');

    # For All Access.
    Route::group(['middleware' => ['role:writer|admin|superadmin|writer']], function () {
        Route::resource('/trip/category', 'TripCategoryController')->only(['create', 'store', 'index']);

        Route::resource('/trip', 'TripController')->only(['create', 'store', 'index', 'show']);

        Route::resource('/destination', 'DestinationController')->only(['create', 'store', 'index']);

        Route::get('/trip-program/{id}', 'TripProgramController@create');
        Route::post('/trip-program', 'TripProgramController@store');

    });

    # For Admins only.
    Route::group(['middleware' => ['role:admin|superadmin']], function () {
        Route::resource('/trip/category', 'TripCategoryController')->only(['edit', 'update']);

        Route::get('/trip-program/{id}/edit', 'TripProgramController@edit');
        Route::put('/trip-program/{id}', 'TripProgramController@update');

        Route::resource('/trip', 'TripController')->only(['edit', 'update']);
        Route::resource('/destination', 'DestinationController')->only(['edit', 'update']);
    });

    # For superadmin only.
    Route::group(['middleware' => ['role:superadmin']], function () {
        Route::get('/trip/category/delete/{id}', 'TripCategoryController@destroy');
        Route::delete('/trip-program/delete/{id}', 'TripProgramController@destroy');
        Route::delete('/destination/delete/{id}', 'DestinationController@destroy');
        Route::get('/trip/delete/{id}', 'TripController@destroy');

    });
});
