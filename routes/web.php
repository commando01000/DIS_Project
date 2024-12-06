<?php

use App\Http\Controllers\Backend\ClientsController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\BanksController;
use App\Http\Controllers\Backend\ChangeStatusController;
use App\Http\Controllers\Backend\ModulesController;
use App\Http\Controllers\LanguageController;

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

// Start Backend Routes //
Route::prefix('admin')->group(function () {
    // Protected routes (only accessible to logged-in admins)
    // Show login form
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    // Handle login
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // Route to show the change password and email form
        Route::get('/change-password', [AdminController::class, 'showPasswordForm'])->name('admin.password');
        Route::post('/password', [AdminController::class, 'updatePassword'])->name('admin.update.password');

        // Logout route
        Route::post('/dashboard/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        // About
        Route::resource('/about-us', AboutController::class)->names([
            'index' => 'admin.about-us',
            'create' => 'admin.about-us.create',
            'store' => 'admin.about-us.store',
            'edit' => 'admin.about-us.edit',
            'update' => 'admin.about-us.update',
            'destroy' => 'admin.about-us.destroy',
        ]);

        // Banks    
        Route::resource('/banks', BanksController::class)->names([
            'index' => 'admin.client',
            'create' => 'admin.client.create',
            'store' => 'admin.client.store',
            'edit' => 'admin.client.edit',
            'update' => 'admin.client.update',
            'destroy' => 'admin.client.destroy',
        ]);
        Route::resource('/modules', ModulesController::class)->names([
            'index' => 'admin.modules',
            'create' => 'admin.modules.create',
            'store' => 'admin.modules.store',
            'edit' => 'admin.modules.edit',
            'update' => 'admin.modules.update',
            'destroy' => 'admin.modules.destroy',
        ]);

        Route::post('/update-status/{form}/{status}', [ChangeStatusController::class, 'UpdateStatus'])->name('update.form.status');
    });
});
// End Backend Routes//



// Start Front End //
Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('home', [HomeController::class, 'index'])->name('home');

    // Lang routes
    Route::get('lang/{locale}', [LanguageController::class, 'switchLocale'])->name('lang');
});
// End Frontend //
