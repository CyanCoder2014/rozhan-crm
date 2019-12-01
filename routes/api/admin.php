<?php

Route::namespace('v1')->prefix('v1')->group(function () {
    Route::post('login', 'AuthController@login');

    Route::prefix('role')
        ->middleware(['jwt.auth', 'role:superadministrator'])
        ->group(function () {
            Route::post('/add', 'RoleController@add');
            Route::get('{id}/permissions', 'RoleController@rolePermissions');

            Route::post('/attach-permissions', 'RoleController@attachPermissions');

            Route::post('/change-user-role', 'RoleController@changeUserRole');

            Route::post('/detach-user-role', 'RoleController@detachUserRoles');

            Route::get('/list', 'RoleController@list');

        });

    Route::prefix('permission')
        ->middleware(['jwt.auth', 'role:superadministrator'])
        ->group(function () {
            Route::get('list', 'PermissionController@list');
        });

    Route::prefix('user')->middleware(['jwt.auth'])->group(function () {
        Route::
//        middleware(['permission:create-users'])->
        post('create', 'UserController@create');


        Route::get('list', 'UserController@list');

    });


    Route::prefix('user-role')
        ->middleware(['jwt.auth', 'role:superadministrator'])
        ->group(function () {
            Route::get('/list', 'UserRoleController@list');
        });

    Route::prefix('user-permission')
        ->middleware(['jwt.auth', 'role:superadministrator'])
        ->group(function () {
            Route::get('/list', 'UserPermissionController@list');
        });



    Route::middleware(['jwt.auth'])->get('/logout', 'AuthController@logout');


});
