<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth',)->group(function () {
    Route::get('/app/dashboard', 'DashboardController@index')->name('app.dashboard');
    
    Route::get('/app/mahasiswa', 'MahasiswaController@index')->name('app.mahasiswa');
    Route::post('/app/mahasiswa', 'MahasiswaController@tambah')->name('app.mahasiswa.tambah');
    Route::get('/app/mahasiswa/{id}', 'MahasiswaController@edit')->name('app.mahasiswa.edit');
    Route::post('/app/mahasiswa/{id}', 'MahasiswaController@simpan')->name('app.mahasiswa.simpan');
    Route::post('/app/mahasiswa/delete/{id}', 'MahasiswaController@hapus')->name('app.mahasiswa.hapus');
});