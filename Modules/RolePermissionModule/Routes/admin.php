<?php
Route::prefix('admin/rolePermission')->middleware('admin')->group(function (){
    Route::resource('role', 'Admin\AdminRoleController',[
        'names' =>
            [
                'index' => 'rolePermission.role.index',
                'store' => 'rolePermission.role.add',
                'update' => 'rolePermission.role.update',
                'destroy' => 'rolePermission.role.delete'
            ],
        'only' =>[
            'index',
            'store',
            'update',
            'destroy'
        ],
        'middleware' => [
            'index' => 'permission:افزودن نقش های مدیران سایت|ویرایش نقش های مدیران سایت|حذف نقش های مدیران سایت',
            'store' => 'permission:افزودن نقش های مدیران سایت',
            'update' => 'permission:ویرایش نقش های مدیران سایت',
            'destroy' => 'permission:حذف نقش های مدیران سایت',
        ],
    ]);
    Route::get('/admin/role/find', 'Admin\AdminRoleController@find')->name('rolePermission.role.find');

    Route::get('/users', 'Admin\UserController@index')
        ->middleware('permission:افزودن مدیر سایت|ویرایش مدیر سایت');
    Route::post('/users', 'Admin\UserController@store')
        ->middleware('permission:افزودن مدیر سایت');
    Route::post('/user/update/{id}', 'Admin\UserController@update')
        ->middleware('permission:ویرایش مدیر سایت');
});

