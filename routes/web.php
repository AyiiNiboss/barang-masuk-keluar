<?php

use App\Models\barangModel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\brg_masukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\kategoriController;
use App\Http\Controllers\laporanController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\permintaanController;
use App\Models\permintaanModel;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticating']);
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register-add', [AuthController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'count']);

    // menu user
    Route::get('/user-active', [AuthController::class, 'index_active']);
    Route::get('/user-inactive', [AuthController::class, 'index_inactive']);
    Route::get('/user-approve/{id}', [AuthController::class, 'approve']);
    Route::get('/user-hapus/{id}', [AuthController::class, 'delete']);
    Route::put('/user-update/{id}', [AuthController::class, 'update']);

    //menu data barang
    Route::get('/barang', [barangController::class, 'index']);
    Route::get('/barang-add-lihat', [barangController::class, 'create'])->name('barang-lihat');
    Route::post('/barang-add', [barangController::class, 'store']);
    Route::get('/barang-edit/{id}', [barangController::class, 'edit']);
    Route::put('/barang-update/{id}', [barangController::class, 'update']);
    Route::get('/barang-hapus/{id}', [barangController::class, 'delete']);

    // menu barang masuk
    Route::get('/barang_masuk', [brg_masukController::class, 'index']);
    Route::get('/barang-masuk/add', [brg_masukController::class, 'create'])->name('brg-masuk-add');
    Route::post('/barang-masuk/add-proses', [brg_masukController::class, 'store']);
    Route::get('/barang-masuk/edit/{id}', [brg_masukController::class, 'edit']);
    Route::put('/barang-masuk/edit-proses/{id}', [brg_masukController::class, 'update']);
    Route::get('/barang-masuk/hapus/{id}', [brg_masukController::class, 'delete']);

    //menu karyawan permintaan barang
    Route::get('/permintaan-barang', [permintaanController::class, 'index']);
    Route::get('/permintaan-barang/detail/{tgl_permintaan}', [permintaanController::class, 'detail']);
    Route::get('/permintaan-barang/add', [permintaanController::class, 'create'])->name('permintaan-add');
    Route::post('/permintaan-barang/add-proses', [permintaanController::class, 'store']);
    Route::get('/permintaan-barang/add/{id}', [permintaanController::class, 'getData']);
    Route::get('/permintaan-barang/hapus/{id}', [permintaanController::class, 'delete']);
    Route::get('/permintaan-barang/pesan', [permintaanController::class, 'pesan']);

    //sapras permintaan barang
    Route::get('/permintaan-barang/sapras', [permintaanController::class, 'indexSapras'])->name('permintaan-sapras');
    Route::get('/permintaan-barang/sapras/{tgl_permintaan}/{id}', [permintaanController::class, 'detailSapras']);
    Route::get('/permintaan-barang/sapras-acc/{id}', [permintaanController::class, 'setujuSapras']);
    Route::get('/permintaan-barang/sapras-tolak/{id}', [permintaanController::class, 'tolakSapras']);
    Route::get('/permintaan-barang/sapras/{id}', [permintaanController::class, 'editSapras']);
    Route::put('/permintaan-barang/sapras-proses/{id}', [permintaanController::class, 'updateSapras']);
    Route::get('/permintaan-barang-keluar', [permintaanController::class, 'tampilPermintaan']);
    Route::get('/permintaan-barang-keluar/hapus/{tgl_permintaan}/{id}', [permintaanController::class, 'deleteBrgKeluar']);
    Route::get('/permintaan-barang-keluar-search', [laporanController::class, 'searchPermintaan'])->name('searchPermintaan');

    //cetak permintaan
    Route::get('/cetak-permintaan', [permintaanController::class, 'tampilCetak']);
    Route::get('/cetak-permintaan/detail/{tgl_permintaan}/{id}', [permintaanController::class, 'detailCetak']);
    Route::get('/permintaan-pdf/{tgl_permintaan}', [pdfController::class, 'index']);

    // Laporan barang
    Route::get('/laporan-barang', [laporanController::class, 'laporanBarang']);
    Route::get('/pencarian-laporan-barang', [laporanController::class, 'searchBarang'])->name('searchBarang');

    // Laporan Barang Masuk
    Route::get('/laporan-barang-masuk', [laporanController::class, 'laporanBarangMasuk']);
    Route::get('/pencarian-laporan-barang-masuk', [laporanController::class, 'searchBarangMasuk'])->name('searchBarangMasuk');

    //Laporan barang keluar
    Route::get('/laporan-barang-keluar', [laporanController::class, 'laporanBarangKeluar']);
    Route::get('/pencarian-laporan-barang-keluar', [laporanController::class, 'searchBarangkeluar'])->name('searchBarangKeluar');

    // kategori
    Route::get('/kategori', [kategoriController::class, 'index']);
    Route::post('/kategori-proses', [kategoriController::class, 'store'])->name('kategori-add');
    Route::put('/kategori-edit/{id}', [kategoriController::class, 'update'])->name('kategori-edit');
    Route::get('/kategori-delete/{id}', [kategoriController::class, 'delete'])->name('kategori-delete');
});
