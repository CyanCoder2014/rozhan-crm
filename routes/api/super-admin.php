<?php

Route::namespace('v1')->prefix('v1')->group(function () {
    Route::post('/login', 'AuthController@login');

    Route::middleware(['jwt.auth'])->post('/reset-password', 'AuthController@resetPassword');
    Route::middleware(['jwt.auth'])->get('/logout', 'AuthController@logout');

    Route::group(['prefix' => 'admin', 'middleware' => ['jwt.auth']], function () {
        Route::post('/', 'AdminController@add');
        Route::get('/', 'AdminController@list');
    });

    Route::group(['prefix' => 'cooperation-account', 'middleware' => ['jwt.auth']], function () {
        Route::patch('/{id}', 'CooperationAccountController@update');
        Route::get('/', 'CooperationAccountController@list');
    });
});