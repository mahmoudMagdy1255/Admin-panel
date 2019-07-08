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
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function() {

    Route::prefix('admin')->group(function () {

        Route::group(['middleware' => 'notadmin', 'namespace' => 'Auth'], function () {

            Route::get('/login', 'LoginController@login')->name('admin.login');
            Route::post('/login', 'LoginController@do_login')->name('admin.login');

        });

        Route::group(['middleware' => 'admin'], function () {

            Route::group(['namespace' => 'Auth'], function () {

                Route::any('/logout', 'LogoutController@logout')->name('admin.logout');

            });


            Route::resource('/admins', 'AdminController');
            Route::delete('/delete/all/admins','AdminController@delete_all')->name('delete_admins');
        });

    });
});