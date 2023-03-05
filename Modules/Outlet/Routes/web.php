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

Route::prefix('outlet')->group(function () {
    Route::get('/', 'OutletController@index');
});

Route::prefix('admin/outlet')->as('outlet-')->namespace('\Modules\Outlet\Http\Controllers\Admin')->middleware(['auth'])->group(function () { // phpcs:ignore

    Route::get('stok-barang/{id}/retur', 'StokBarangController@retur');
    Route::put('stok-barang/{id}/retur', 'StokBarangController@update_retur');
    Route::resource('stok-barang', 'StokBarangController')->except(['show', 'create', 'store', 'destroy']);

    Route::resource('order-barang', 'OrderBarangController')->except(['show', 'create', 'store', 'edit', 'destroy']);

    Route::resource('retur-barang', 'ReturBarangController')->except(['show', 'create', 'store', 'edit', 'destroy']);

    Route::resource('transaksi', 'TransaksiController')->except(['show', 'edit', 'update', 'destroy']);
});
