<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\SuratIzinController;
use App\Http\Controllers\AbsensiGuruController;
use App\Http\Controllers\AbsensiMapelController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SuratTerlambatController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\PermissionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route Login
Route::post('/login', [App\Http\Controllers\Api\Auth\LoginController::class, 'index']);

// group route with middleware "auth"
Route::group(['middleware' => 'auth:api'], function () {
    // logout
    Route::post('/logout', [App\Http\Controllers\Api\Auth\LoginController::class, 'logout']);
});

// Route::middleware('auth:api')->group(function () {
//     Route::get('/admin/dashboard', [DashboardController::class, 'index']);
// });

Route::prefix('admin')->group(function () {
    // group route with middleware "auth:api"
    Route::group(['middleware' => 'auth:api'], function () {

        // Permissions
        Route::get('/permissions', [\App\Http\Controllers\Api\Admin\PermissionController::class, 'index'])->middleware('permission:permissions.index');

        // Permissions All
        Route::get('/permissions/all', [\App\Http\Controllers\Api\Admin\PermissionController::class, 'all'])->middleware('permission:permissions.index');

        Route::get('/dashboard', [DashboardController::class, 'index']);

       }); 
});

Route::prefix('absensi')->group(function () {
    // Absensi routes
    Route::get('/', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/store', [AbsensiController::class, 'store'])->name('absensi.store');
    Route::get('/{id}', [AbsensiController::class, 'show'])->name('absensi.show');
    Route::put('/{id}', [AbsensiController::class, 'update'])->name('absensi.update');
    Route::delete('/{id}', [AbsensiController::class, 'destroy'])->name('absensi.destroy');
});

Route::prefix('absensi_guru')->group(function () {
    // Absensi Guru routes
    Route::get('/', [AbsensiGuruController::class, 'index'])->name('absensi_guru.index');
    Route::post('/store', [AbsensiGuruController::class, 'store'])->name('absensi_guru.store');
    Route::get('/{id}', [AbsensiGuruController::class, 'show'])->name('absensi_guru.show');
    Route::put('/{id}', [AbsensiGuruController::class, 'update'])->name('absensi_guru.update');
    Route::delete('/{id}', [AbsensiGuruController::class, 'destroy'])->name('absensi_guru.destroy');
});

Route::prefix('suratizin')->group(function () {
    // Surat Izin routes
    Route::get('/', [SuratIzinController::class, 'index'])->name('suratizin.index');
    Route::post('/store', [SuratIzinController::class, 'store'])->name('suratizin.store');
    Route::get('/{id}', [SuratIzinController::class, 'show'])->name('suratizin.show');
    Route::put('/{id}', [SuratIzinController::class, 'update'])->name('suratizin.update');
    Route::delete('/{id}', [SuratIzinController::class, 'destroy'])->name('suratizin.destroy');
});

Route::prefix('suratterlambat')->group(function () {
    // Surat Terlambat routes
    Route::get('/', [SuratTerlambatController::class, 'index'])->name('suratterlambat.index');
    Route::post('/store', [SuratTerlambatController::class, 'store'])->name('suratterlambat.store');
    Route::get('/{id}', [SuratTerlambatController::class, 'show'])->name('suratterlambat.show');
    Route::put('/{id}', [SuratTerlambatController::class, 'update'])->name('suratterlambat.update');
    Route::delete('/{id}', [SuratTerlambatController::class, 'destroy'])->name('suratterlambat.destroy');
});

Route::prefix('absensimapels')->group(function () {
    // Surat Terlambat routes
    Route::get('/', [AbsensiMapelController::class, 'index'])->name('absensimapel.index');
    Route::post('/store', [AbsensiMapelController::class, 'store'])->name('absensimapel.store');
    Route::get('/{id}', [AbsensiMapelController::class, 'show'])->name('absensimapel.show');
    Route::put('/{id}', [AbsensiMapelController::class, 'update'])->name('absensimapel.update');
    Route::delete('/{id}', [AbsensiMapelController::class, 'destroy'])->name('absensimapel.destroy');
});

Route::prefix('users')->group(function () {
     // group route with middleware "auth:api"
     Route::group(['middleware' => 'auth:api'], function () {
     // User routes
     Route::get('/', [UserController::class, 'index'])->name('users.index');
     Route::post('/store', [UserController::class, 'store'])->name('users.store');
     Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
     Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
     Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});
}); 