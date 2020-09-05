<?php
//dd( config('ordermate') );
//Route::group( ['middleware' => 'auth', ]);

//ajax
Route::get( '/ordersmate/get_users/', '\CyberCraft\OrderMate\Controllers\AjaxController@get_users')->name('ordermate.ajax.get_users');

//install
Route::get( '/ordermate/prompt', '\CyberCraft\OrderMate\Controllers\InstallController@prompt')->name('ordermate.install.prompt');
Route::get( '/ordermate/install', '\CyberCraft\OrderMate\Controllers\InstallController@install')->name('ordermate.install.process');

Route::group(['middleware' => ['web']], function () {
    Route::get( '/dashboard', '\CyberCraft\OrderMate\Controllers\DashboardController@index' )->name('ordermate.dashboard');
    Route::get( '/orders', '\CyberCraft\OrderMate\Controllers\OrdersController@index' )->name('ordermate.orders.index');
    Route::get( '/orders/create', '\CyberCraft\OrderMate\Controllers\OrdersController@create' )->name('ordermate.orders.create');
    Route::post( '/orders/store', '\CyberCraft\OrderMate\Controllers\OrdersController@store' )->name('ordermate.orders.store');
    Route::get( '/orders/show/{id}', '\CyberCraft\OrderMate\Controllers\OrdersController@show' )->name('ordermate.orders.show');
    Route::get( '/customers/show/{id}/pdf', '\CyberCraft\OrderMate\Controllers\OrdersController@order_detail_pdf' )->name('ordermate.orders.show.pdf');
    Route::get( '/orders/edit/{id}', '\CyberCraft\OrderMate\Controllers\OrdersController@edit' )->name('ordermate.orders.edit');
    Route::post( '/orders/update/{id}', '\CyberCraft\OrderMate\Controllers\OrdersController@update' )->name('ordermate.orders.update');
    Route::delete( '/orders/delete/{id}', '\CyberCraft\OrderMate\Controllers\OrdersController@destroy' )->name('ordermate.orders.delete');

    //customers
    Route::get( '/customers', '\CyberCraft\OrderMate\Controllers\CustomerController@index' )->name('ordermate.customers.index');
    Route::get( '/customers/create', '\CyberCraft\OrderMate\Controllers\CustomerController@create' )->name('ordermate.customers.create');
    Route::post( '/customers/store', '\CyberCraft\OrderMate\Controllers\CustomerController@store' )->name('ordermate.customers.store');
    Route::get( '/customers/show/{id}', '\CyberCraft\OrderMate\Controllers\CustomerController@show' )->name('ordermate.customers.show');
    Route::get( '/customers/edit/{id}', '\CyberCraft\OrderMate\Controllers\CustomerController@edit' )->name('ordermate.customers.edit');
    Route::patch( '/customers/update/{id}', '\CyberCraft\OrderMate\Controllers\CustomerController@update' )->name('ordermate.customers.update');
    Route::delete( '/customers/delete/{id}', '\CyberCraft\OrderMate\Controllers\CustomerController@destroy' )->name('ordermate.customers.delete');

    //ajax
    Route::post( '/customers/orders', '\CyberCraft\OrderMate\Controllers\OrdersController@index' )->name('ordermate.ajax.customer.orders');
});
