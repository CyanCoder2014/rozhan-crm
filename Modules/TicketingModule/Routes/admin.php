<?php
Route::prefix('admin/ticketing')->middleware('admin')->namespace('Admin')->group(function() {
    Route::get('/', 'AdminTicketController@index')->name('ticketingmodule.admin.ticket.index')->middleware('permission:نمایش پاسخ تیکت|افزودن تیکت|پاسخ به تیکت|حذف تیکت');
    Route::post('/', 'AdminTicketController@store')->name('ticketingmodule.admin.ticket.store')->middleware('permission:افزودن تیکت');
    Route::get('/{ticket}/show', 'AdminTicketController@show')->name('ticketingmodule.admin.ticket.show')->middleware('permission:پاسخ به تیکت|نمایش پاسخ تیکت');
    Route::post('/{ticket}/reply', 'AdminTicketController@reply')->name('ticketingmodule.admin.ticket.reply')->middleware('permission:پاسخ به تیکت');
    Route::get('/{ticket}/delete', 'AdminTicketController@destroy')->name('ticketingmodule.admin.ticket.delete')->middleware('permission:حذف تیکت');
    Route::get('/find/user', 'AdminTicketController@findUser')->name('ticketingmodule.admin.user.find')->middleware('permission:افزودن تیکت');

    Route::prefix('category')->group(function (){
        Route::get('/', 'AdminTicketCategoryController@index')->name('ticketingmodule.admin.category.index')->middleware('permission:افزودن دسته بندی تیکت|ویرایش دسته بندی تیکت|حذف دسته بندی تیکت');
        Route::post('/', 'AdminTicketCategoryController@store')->name('ticketingmodule.admin.category.store')->middleware('permission:افزودن دسته بندی تیکت');
        Route::post('/{id}', 'AdminTicketCategoryController@update')->name('ticketingmodule.admin.category.update')->middleware('permission:ویرایش دسته بندی تیکت');
        Route::get('/{id}/delete', 'AdminTicketCategoryController@destroy')->name('ticketingmodule.admin.category.delete')->middleware('permission:حذف دسته بندی تیکت');
    });
});
