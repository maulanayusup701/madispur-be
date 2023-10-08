<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\LogAccountController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\Account\AccountController;
use App\Http\Controllers\Api\Account\AccountAdminController;
use App\Http\Controllers\Api\Account\AccountPesertaController;
use App\Http\Controllers\Api\Account\AccountSuperAdminController;

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

Route::middleware('guest')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'login')->name('login'); //menampilkan form login
        Route::post('/login-store', 'loginStore'); //proses authentikasi
        Route::get('/register', 'register'); //menampilkan form register
        Route::post('/register-store', 'registerStore'); //proses registrasi
        Route::get('/email/{id}', 'emailVerify')->name('verification.verify'); //proses verification email
    });

    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('/password-reset', 'emailRequest')->name('password.request'); //tampilkan form email reset password
        Route::post('/send-password-email', 'sendResetLinkEmail')->name('password.email'); //kirim email ke user
        Route::get('/password-reset/{token}', 'showResetForm')->name('password.reset'); //tampilkan form password baru {token}
        Route::post('/password-reset/{token}', 'passwordReset'); //proses reset password
    });

});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard/profile', 'profile');
    });
    Route::resource('/dashboard/permission', PermissionController::class);
    Route::post('/dashboard/permission/search', [SearchController::class, 'permissionSearch']);
    Route::resource('/dashboard/menu', MenuController::class);
    Route::post('/dashboard/menu/search', [SearchController::class, 'menuSearch']);
    Route::get('/dashboard/aktivitas', [LogAccountController::class, 'index']);
    Route::post('logout', [AuthController::class, 'logout']);
});
Route::get('/dashboard/account', [AccountController::class, 'index']);
Route::resource('/dashboard/account/super-admin', AccountSuperAdminController::class);
Route::resource('/dashboard/account/admin', AccountAdminController::class);
Route::resource('/dashboard/account/peserta', AccountPesertaController::class);
