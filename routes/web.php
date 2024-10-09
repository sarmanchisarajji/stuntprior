<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HasilAkhirController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\SmarterController;
use App\Http\Controllers\SubKriteriaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/logout', [AuthController::class, 'logout']);


Route::get('/', function () {
    return redirect()->route('guest.dashboard');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login/auth', [AuthController::class, 'auth']);
    Route::get('/guest/dashboard', [DashboardController::class, 'indexGuestDashboard'])->name('guest.dashboard');
    Route::get('/guest/dashboard-tahun', [DashboardController::class, 'indexGuestDashboard'])->name('guest.dashboard.tahun');
    Route::get('/guest/data-akhir', [HasilAkhirController::class, 'indexGuestHasilAkhir']);
});


// Halaman Admin Harus Login
Route::middleware(['auth'])->group(function () {
    Route::middleware(['can:dinkes'])->group(function () {
        //Halaman Dashboard
        Route::get('/admin/dashboard', [DashboardController::class, 'indexDashboard']);
        Route::get('/admin/dashboard-tahun', [DashboardController::class, 'indexDashboard'])->name('dashboard');

        //Halaman Alternatif
        Route::get('/admin/data-alternatif', [AlternatifController::class, 'indexAlternatif']);
        Route::post('/admin/data-alternatif/tambah-alternatif', [AlternatifController::class, 'tambahAlternatif']);
        Route::put('/admin/data-alternatif/edit-alternatif/{id}', [AlternatifController::class, 'editAlternatif']);
        Route::delete('/admin/data-alternatif/hapus-alternatif/{id}', [AlternatifController::class, 'hapusAlternatif']);


        //Halaman Kriteria
        Route::get('/admin/data-kriteria', [KriteriaController::class, 'indexKriteria']);
        Route::post('/admin/data-kriteria/tambah-kriteria', [KriteriaController::class, 'tambahKriteria']);
        Route::put('/admin/data-kriteria/edit-kriteria/{id}', [KriteriaController::class, 'editKriteria']);
        Route::delete('/admin/data-kriteria/hapus-kriteria/{id}', [KriteriaController::class, 'hapusKriteria']);

        //Halaman SubKriteria
        Route::get('/admin/data-subkriteria', [SubKriteriaController::class, 'indexSubkriteria']);
        Route::post('/admin/data-subkriteria/tambah-subkriteria/{id}', [SubkriteriaController::class, 'tambahSubkriteria']);
        Route::put('/admin/data-subkriteria/edit-subkriteria/{id}', [SubkriteriaController::class, 'editSubkriteria']);
        Route::delete('/admin/data-subkriteria/hapus-subkriteria/{id}', [SubkriteriaController::class, 'hapusSubkriteria']);


        //Halaman Penilaian
        Route::get('/admin/data-penilaian', [PenilaianController::class, 'indexPenilaian']);
        Route::post('/admin/data-penilaian', [PenilaianController::class, 'indexPenilaian']);
        Route::put('/admin/data-penilaian/edit-penilaian/{id}', [PenilaianController::class, 'editPenilaian']);


        //Halaman Perhitungan
        Route::get('/admin/data-perhitungan', [SmarterController::class, 'indexPerhitungan']);
        Route::get('/admin/perhitungan', [SmarterController::class, 'indexPerhitungan'])->name('perhitungan.index');


        //Halaman Akhir
        Route::get('/admin/data-akhir', [HasilAkhirController::class, 'indexHasilAkhir']);
    });
});
