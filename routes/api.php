<?php

use App\Http\Controllers\AbsensiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\AbsensiGuruController;
use App\Http\Controllers\SuratIzinController;

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
Route::group(['middleware' => 'auth:api'], function(){
    // logout
    Route::post('/logout', [App\Http\Controllers\Api\Auth\LoginController::class, 'logout']);
});

Route::prefix('admin')->group(function(){
    // group route with middleware "auth:api"
    Route::group(['middleware' => 'auth:api'], function(){
        // // dashboard
        // Route::get('/dashboard', App\Http\Controllers\Api\Admin\DashboardController::class);

        // Permissions
        Route::get('/permissions', [\App\Http\Controllers\Api\Admin\PermissionController::class, 'index'])->middleware('permission:permissions.index');

        // Permissions All
        Route::get('/permissions/all', [\App\Http\Controllers\Api\Admin\PermissionController::class, 'all'])->middleware('permission:permissions.index');

        // // roles all
        // Route::get('/roles/all', [\App\Http\Controllers\Api\Admin\RoleController::class, 'all'])->middleware('permission:roles.index');

        // // roles
        // Route::apiResource('/roles', \App\Http\Controllers\Api\Admin\RoleController::class)->middleware('permission:roles.index|roles.store|roles.update|roles.delete');

        // //users
        // Route::apiResource('/users', App\Http\Controllers\Api\Admin\UserController::class)->middleware('permission:users.index|users.store|users.update|users.delete');

        // //Categories
        // Route::apiResource('/categories', App\Http\Controllers\Api\Admin\CategoryController::class)->middleware('permission:categories.index|categories.store|categories.update|categories.delete');

        // //Posts
        // Route::apiResource('/posts', App\Http\Controllers\Api\Admin\PostController::class)->middleware('permission:posts.index|posts.store|posts.update|posts.delete');
    });
});
// Route::middleware(['auth:api'])->group(function () {
//     Route::apiResource('/absensi', AbsensiController::class)->middleware('permission:tambah-absensi|');
//     Route::apiResource('/absensi/guru', AbsensiGuruController::class);
// });

// in routes/api.php

Route::apiResource('/suratIzin', SuratIzinController::class);
