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

Route::prefix('gudang-cabang')->group(function () {
    Route::get('/', 'GudangCabangController@index');
});

Route::prefix('admin/gudang-cabang')->as('gudang-cabang-')->namespace('\Modules\GudangCabang\Http\Controllers\Admin')->middleware(['auth'])->group(function () { // phpcs:ignore

    Route::get('stok-barang/{id}/retur', 'StokBarangController@retur');
    Route::put('stok-barang/{id}/retur', 'StokBarangController@update_retur');
    Route::resource('stok-barang', 'StokBarangController')->except(['show', 'create', 'store', 'destroy']);

    Route::resource('order-barang', 'OrderBarangController')->except(['show', 'create', 'store', 'edit', 'destroy']);

    Route::resource('retur-barang', 'ReturBarangController')->except(['show', 'create', 'store', 'edit', 'destroy']);

    Route::get('permintaan-order/{id}', 'PermintaanBarangController@update');
    Route::resource('permintaan-order', 'PermintaanBarangController')->except(['show', 'create', 'store', 'edit', 'destroy', 'update']);

    Route::get('permintaan-retur/{id}', 'PermintaanReturController@update');
    Route::resource('permintaan-retur', 'PermintaanReturController')->except(['show', 'create', 'store', 'edit', 'destroy', 'update']);
});
