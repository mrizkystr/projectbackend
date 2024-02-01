<?php

use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AbsensiGuruController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratTerlambatController;
use App\Http\Controllers\SuratIzinController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('/users', UserController::class);
});


// //route absensi
// Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index');
// Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create');
// Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store');
// Route::get('/absensi/{absensi}', [AbsensiController::class, 'show'])->name('absensi.show');
// Route::get('/absensi/{absensi}/edit', [AbsensiController::class, 'edit'])->name('absensi.edit');
// Route::put('/absensi/{absensi}', [AbsensiController::class, 'update'])->name('absensi.update');
// Route::delete('/absensi/{absensi}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');

// //route absensi guru
// Route::get('/absensi-gurus', [AbsensiGuruController::class, 'index'])->name('absensi-gurus.index');
// Route::post('/absensi-gurus', [AbsensiGuruController::class, 'store'])->name('absensi-gurus.store');
// Route::get('/absensi-gurus/{absensi_guru}', [AbsensiGuruController::class, 'show'])->name('absensi-gurus.show');
// Route::put('/absensi-gurus/{absensi_guru}', [AbsensiGuruController::class, 'update'])->name('absensi-gurus.update');
// Route::delete('/absensi-gurus/{absensi_guru}', [AbsensiGuruController::class, 'destroy'])->name('absensi-gurus.destroy');

// //route surat izin
// Route::get('/surat-izin', [SuratIzinController::class, 'index'])->name('suratIzin.index');
// Route::post('/surat-izin', [SuratIzinController::class, 'store'])->name('suratIzin.store');
// Route::get('/surat-izin/{suratIzin}', [SuratIzinController::class, 'show'])->name('suratIzin.show');
// Route::put('/surat-izin/{suratIzin}', [SuratIzinController::class, 'update'])->name('suratIzin.update');
// Route::delete('/surat-izin/{suratIzin}', [SuratIzinController::class, 'destroy'])->name('suratIzin.destroy');

// //route surat terlambat
// Route::get('/surat-terlambat', [SuratTerlambatController::class, 'index'])->name('suratterlambat.index');
// Route::get('/surat-terlambat/create', [SuratTerlambatController::class, 'create'])->name('suratterlambat.create');
// Route::post('/surat-terlambat', [SuratTerlambatController::class, 'store'])->name('suratterlambat.store');
// Route::get('/surat-terlambat/{suratTerlambat}/edit', [SuratTerlambatController::class, 'edit'])->name('suratterlambat.edit');
// Route::put('/surat-terlambat/{suratTerlambat}', [SuratTerlambatController::class, 'update'])->name('suratterlambat.update');
// Route::delete('/surat-terlambat/{suratTerlambat}', [SuratTerlambatController::class, 'destroy'])->name('suratterlambat.destroy');




// Route::middleware(['auth'])->group(function () {
//     Route::apiResource('/absensi', AbsensiController::class);
//     Route::apiResource('/absensi/guru', AbsensiGuruController::class);
// });

// Route::middleware(['auth'])->group(function () {
//     Route::get('/', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// require __DIR__ . '/auth.php';
