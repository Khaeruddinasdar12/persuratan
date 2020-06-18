<?php

Auth::routes(['verify' => true]);
// Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('riwayat-peminjaman', 'Transaksi@get_pernah_pinjam')->name('pernahpinjam');

//Index semua halaman
Route::get('data-barang', 'DataBarang@index')->name('data-barang.index');
Route::get('peminjaman', 'Transaksi@index')->name('peminjaman.index');
Route::get('user', 'User@index')->name('user.index');
Route::get('persuratan', 'Persuratan@index')->name('persuratan.index');
Route::get('papan-informasi', 'PapanInformasi@index')->name('papaninformasi.index');
Route::get('perpustakaan', 'Perpustakaan@index')->name('perpustakaan.index');
Route::get('informasi', 'ClientInformasi@papaninfo')->name('informasi.index'); //papan informasi untuk Client

// API data tools & properties dalam datatable --> tetap harus auth
Route::get('tableuser', 'User@tableuser')->name('tableuser');
Route::get('tablepeminjaman', 'Transaksi@tablepeminjaman')->name('tablepeminjaman');
Route::get('tablebarang', 'DataBarang@tablebarang')->name('tablebarang');
Route::get('table-pernah-pinjam', 'Transaksi@pernahpinjam')->name('tablepernahpinjam');
Route::get('table-perpustakaan', 'Perpustakaan@tableperpustakaan')->name('tableperpustakaan');
Route::get('table-papan-informasi', 'PapanInformasi@tablepapaninformasi')->name('tablepapaninformasi');

// API data administrasi dalam datatable --> tetap harus auth
Route::get('table_surat_masuk', 'Persuratan@surat_masuk')->name('surat_masuk');
Route::get('table_surat_keluar', 'Persuratan@surat_keluar')->name('surat_keluar');



// DIVIS TOOLS AND PROPERTIES
Route::group(['middleware' => 'App\Http\Middleware\InventarisMiddleware'], function() {
	//CRUD Barang
	Route::post('data-barang', 'DataBarang@store')->name('data-barang.store');
	Route::get('data-barang/{id}/edit', 'DataBarang@edit');
	Route::put('data-barang/{id}', 'DataBarang@update');
	Route::delete('data-barang/{id}', 'Databarang@destroy');
	Route::get('cekstok/{id}', 'Databarang@cekstok');

	//CRUD Peminjaman
	Route::post('peminjaman', 'Transaksi@store')->name('peminjaman.store');
	Route::get('peminjaman/{id}/edit', 'Transaksi@edit');
	Route::put('peminjaman/{id}', 'Transaksi@update');
	Route::delete('peminjaman/{id}', 'Transaksi@destroy');
	Route::delete('pernahpinjam/{id}', 'Transaksi@hapuspernahpinjam');

	//CRUD Perpustakaan
	Route::post('perpustakaan', 'Perpustakaan@store')->name('perpustakaan.store');
	Route::get('perpustakaan/{id}/edit', 'Perpustakaan@edit');
	Route::put('perpustakaan/{id}', 'Perpustakaan@update');
	Route::delete('perpustakaan/{id}', 'Perpustakaan@destroy');

	//CRUD Papan Informasi
	Route::post('papan-informasi', 'PapanInformasi@store')->name('papaninformasi.store');
	Route::get('papan-informasi/{id}/edit', 'PapanInformasi@edit');
	Route::put('papan-informasi/{id}', 'PapanInformasi@update');
	Route::delete('papan-informasi/{id}', 'PapanInformasi@destroy');
});



// SEKRETARIS UMUM
Route::group(['middleware' => 'App\Http\Middleware\SekumMiddleware'], function() {
	Route::post('registrasi', 'User@store')->name('registrasi');
	Route::get('user/{id}/edit', 'User@edit');
	Route::delete('user/{id}', 'User@destroy');
	Route::put('user/{id}', 'User@update');

	Route::post('persuratan', 'Persuratan@store')->name('persuratan.store');
	Route::get('persuratan/{id}/edit', 'Persuratan@edit');
	Route::delete('persuratan/{id}', 'Persuratan@destroy');
	Route::put('persuratan/{id}', 'Persuratan@update');
});