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
    return redirect()->route('app.dashboard');
});

Auth::routes();

Route::middleware('auth:web',)->group(function () {
    Route::get('/app', function ()
    {
        return redirect()->route('app.dashboard');
    });
    Route::get('/app/dashboard', 'Admin\DashboardController@index')->name('app.dashboard');
    
    Route::get('/app/profile', "Admin\ProfileController@index")->name('app.profile');
    Route::post('/app/profile', "Admin\ProfileController@update")->name('app.profile.post');

    Route::get('/app/mahasiswa', 'Admin\MahasiswaController@index')->name('app.mahasiswa');
    Route::post('/app/mahasiswa', 'Admin\MahasiswaController@tambah')->name('app.mahasiswa.tambah');
    Route::get('/app/mahasiswa/{id}', 'Admin\MahasiswaController@edit')->name('app.mahasiswa.edit');
    Route::post('/app/mahasiswa/{id}', 'Admin\MahasiswaController@simpan')->name('app.mahasiswa.simpan');
    Route::post('/app/mahasiswa/delete/{id}', 'Admin\MahasiswaController@hapus')->name('app.mahasiswa.hapus');
});

Route::get('/student/login', "Auth\MahasiswaAuthController@login")->name('mahasiswa.login');
Route::post('/student/login', "Auth\MahasiswaAuthController@postLogin")->name('mahasiswa.postLogin');

Route::middleware('auth:mahasiswa')->group(function () {
    Route::get('/student', "Mahasiswa\MahasiswaController@index")->name('mahasiswa.app');

    Route::get('/student/profile', "Mahasiswa\ProfileController@index")->name('mahasiswa.profile');
    Route::post('/student/profile', "Mahasiswa\ProfileController@update")->name('mahasiswa.profile.post');
    
    Route::get('/student/kendaraan', "Mahasiswa\KendaraanController@index")->name('mahasiswa.kendaraan');
    Route::post('/student/kendaraan', "Mahasiswa\KendaraanController@tambah")->name('mahasiswa.kendaraan.tambah');
    Route::get('/student/kendaraan/{id}', "Mahasiswa\KendaraanController@detail")->name('mahasiswa.kendaraan.detail');
    Route::post('/student/kendaraan/{id}', "Mahasiswa\KendaraanController@simpan")->name('mahasiswa.kendaraan.simpan');
    Route::post('/student/kendaraan/delete/{id}', "Mahasiswa\KendaraanController@hapus")->name('mahasiswa.kendaraan.hapus');

    Route::get('/student/simulator', "Mahasiswa\SimulatorController@index")->name('mahasiswa.simulator');
    Route::post('/student/simulator', "Mahasiswa\SimulatorController@parkir")->name('mahasiswa.simulator.post');
});