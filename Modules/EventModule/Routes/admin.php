<?php
Route::prefix('admin/events')->middleware('admin')->namespace('Admin')->group(function() {
    Route::get('/', 'AdminEventController@index')->name('eventmodule.admin.event.index');
    Route::post('/store', 'AdminEventController@store')->name('eventmodule.admin.event.store');
    Route::get('/{event}/edit', 'AdminEventController@edit')->name('eventmodule.admin.event.edit');
    Route::post('/{event}/update', 'AdminEventController@update')->name('eventmodule.admin.event.update');
    Route::get('/{event}/delete', 'AdminEventController@destroy')->name('eventmodule.admin.event.delete');


    Route::prefix('category')->group(function (){
        Route::get('/', 'AdminEventCategoryController@index')->name('eventmodule.admin.category.index');//->middleware('permission:افزودن دسته بندی تیکت|ویرایش دسته بندی تیکت|حذف دسته بندی تیکت');
        Route::post('/', 'AdminEventCategoryController@store')->name('eventmodule.admin.category.store');//->middleware('permission:افزودن دسته بندی تیکت');
        Route::post('/{id}', 'AdminEventCategoryController@update')->name('eventmodule.admin.category.update');//->middleware('permission:ویرایش دسته بندی تیکت');
        Route::get('/{id}/delete', 'AdminEventCategoryController@destroy')->name('eventmodule.admin.category.delete');//->middleware('permission:حذف دسته بندی تیکت');
    });
});