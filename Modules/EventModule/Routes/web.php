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
include ('admin.php');
Route::prefix('event')->group(function() {
    Route::get('/{event}', 'EventController@show')->name('eventmodule.event.show');
    Route::get('/user/registers', 'EventRegisterController@index')->name('eventmodule.event.register.list');
    Route::get('/{event}/register', 'EventRegisterController@create')->name('eventmodule.event.register');
    Route::post('/{event}/register', 'EventRegisterController@store');
});
