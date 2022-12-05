<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('periode', 'Admin\PeriodeController');
    Route::resource('fakultas', 'Admin\FakultasController');
    Route::resource('prodi', 'Admin\ProdiController');
    Route::resource('matakuliah', 'Admin\MatakuliahController');
    Route::resource('kurikulum', 'Admin\KurikulumController');
    Route::resource('pegawai', 'Admin\PegawaiController');
    Route::resource('jabatan', 'Admin\JabatanController');
    Route::resource('jabatan-akademik', 'Admin\JabatanAkademikController');
    Route::resource('jabatan-pegawai', 'Admin\JabatanPegawaiController');

    Route::get('/add-matakuliah-kurikulum/{id}','Admin\MatakuliahKurikulumController@index')->name('setting.mkkurikulum');
    Route::get('/add-matakuliah-kurikulums/{id}','Admin\MatakuliahKurikulumController@listMK')->name('list.mkkurikulum');
    Route::delete('/del-matakuliah-kurikulum/{id}','Admin\MatakuliahKurikulumController@destroy')->name('del.mkkurikulum');

});
