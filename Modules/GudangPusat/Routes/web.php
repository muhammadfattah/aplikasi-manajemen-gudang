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

    // Route::get('posts/trashed', 'PostController@trashed')->name('posts.trashed');
    // Route::get('posts/{id}/restore', 'PostController@restore')->name('posts.restore');
    // Route::resource('posts', 'PostController');

    // Route::get('pages/trashed', 'PageController@trashed')->name('pages.trashed');
    // Route::get('pages/{id}/restore', 'PageController@restore')->name('pages.restore');
    // Route::resource('pages', 'PageController');

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
});
