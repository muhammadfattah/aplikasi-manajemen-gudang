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

Route::prefix('gudang-pusat')->group(function () {
    Route::get('/', 'GudangPusatController@index');
});

Route::prefix('admin/gudang-pusat')->as('gudang-pusat-')->namespace('\Modules\GudangPusat\Http\Controllers\Admin')->middleware(['auth'])->group(function () { // phpcs:ignore

    Route::resource('supplier', 'SupplierController')->except('show');
    Route::get('supplier/{id}/restore', 'SupplierController@restore')->name('supplier.restore');
    Route::get('supplier/trashed', 'SupplierController@trashed')->name('supplier.trashed');

    Route::resource('cabang', 'CabangController')->except('show');
    Route::get('cabang/{id}/restore', 'CabangController@restore')->name('cabang.restore');
    Route::get('cabang/trashed', 'CabangController@trashed')->name('cabang.trashed');

    Route::resource('kategori-barang', 'KategoriBarangController')->except('show');
    Route::get('kategori-barang/{id}/restore', 'KategoriBarangController@restore')->name('kategori-barang.restore');
    Route::get('kategori-barang/trashed', 'KategoriBarangController@trashed')->name('kategori-barang.trashed');

    Route::resource('outlet', 'OutletController')->except('show');
    Route::get('outlet/{id}/restore', 'OutletController@restore')->name('outlet.restore');
    Route::get('outlet/trashed', 'OutletController@trashed')->name('outlet.trashed');

    Route::resource('stok-barang', 'StokBarangController')->except('show');
    Route::get('stok-barang/{id}/restore', 'StokBarangController@restore')->name('stok-barang.restore');
    Route::get('stok-barang/{id}/tambah-stok', 'StokBarangController@tambah_stok')->name('stok-barang.tambah-stok');
    Route::put('stok-barang/update-stok/{id}', 'StokBarangController@update_stok')->name('stok-barang.update-stok');
    Route::get('stok-barang/trashed', 'StokBarangController@trashed')->name('stok-barang.trashed');

    Route::get('permintaan-order/{id}', 'PermintaanBarangController@update');
    Route::resource('permintaan-order', 'PermintaanBarangController')->except(['show', 'create', 'store', 'edit', 'destroy', 'update']);

    Route::get('permintaan-retur/{id}', 'PermintaanReturController@update');
    Route::resource('permintaan-retur', 'PermintaanReturController')->except(['show', 'create', 'store', 'edit', 'destroy', 'update']);
});
