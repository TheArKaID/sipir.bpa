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

Route::middleware('auth:web',)->group(function () {
    Route::get('/app/dashboard', 'Admin\DashboardController@index')->name('app.dashboard');
    
    Route::get('/app/mahasiswa', 'Admin\MahasiswaController@index')->name('app.mahasiswa');
    Route::post('/app/mahasiswa', 'Admin\MahasiswaController@tambah')->name('app.mahasiswa.tambah');
    Route::get('/app/mahasiswa/{id}', 'Admin\MahasiswaController@edit')->name('app.mahasiswa.edit');
    Route::post('/app/mahasiswa/{id}', 'Admin\MahasiswaController@simpan')->name('app.mahasiswa.simpan');
    Route::post('/app/mahasiswa/delete/{id}', 'Admin\MahasiswaController@hapus')->name('app.mahasiswa.hapus');
});

Route::get('/student/login', "Auth\MahasiswaAuthController@login")->name('mahasiswa.login');
Route::post('/student/login', "Auth\MahasiswaAuthController@postLogin")->name('mahasiswa.postLogin');

Route::middleware('auth:mahasiswa',)->group(function () {
    Route::get('/m', "Mahasiswa\MahasiswaController@index")->name('mahasiswa.app');
    Route::get('/m/kendaraan', "Mahasiswa\KendaraanController@index")->name('mahasiswa.kendaraan');
});