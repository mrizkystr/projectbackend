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

Route::middleware(['auth'])->group(function () {
    Route::apiResource('/absensi', AbsensiController::class);
    Route::apiResource('/absensi/guru', AbsensiGuruController::class);
});

Route::get('surat-izin', [SuratIzinController::class, 'index'])->name('suratIzin.index');
Route::post('surat-izin', [SuratIzinController::class, 'store'])->name('suratIzin.store');
Route::get('surat-izin/{suratIzin}', [SuratIzinController::class, 'show'])->name('suratIzin.show');
Route::put('surat-izin/{suratIzin}', [SuratIzinController::class, 'update'])->name('suratIzin.update');
Route::delete('surat-izin/{suratIzin}', [SuratIzinController::class, 'destroy'])->name('suratIzin.destroy');
Route::get('/surat-terlambat', [SuratTerlambatController::class, 'index'])->name('suratterlambat.index');
Route::get('/surat-terlambat/create', [SuratTerlambatController::class, 'create'])->name('suratterlambat.create');
Route::post('/surat-terlambat', [SuratTerlambatController::class, 'store'])->name('suratterlambat.store');
Route::get('/surat-terlambat/{suratTerlambat}/edit', [SuratTerlambatController::class, 'edit'])->name('suratterlambat.edit');
Route::put('/surat-terlambat/{suratTerlambat}', [SuratTerlambatController::class, 'update'])->name('suratterlambat.update');
Route::delete('/surat-terlambat/{suratTerlambat}', [SuratTerlambatController::class, 'destroy'])->name('suratterlambat.destroy');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// require __DIR__ . '/auth.php';
