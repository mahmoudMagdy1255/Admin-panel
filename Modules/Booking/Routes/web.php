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

    Route::resource('/booking', 'BookingController')->only(['create', 'store', 'index', 'show','edit']);
    
    Route::get('/book/ajax', 'BookingController@dataTables');

    # For superadmin only.
    Route::group(['middleware' => ['role:superadmin']], function () {
        Route::get('/booking/delete/{id}', 'BookingController@destroy');
    });

});
