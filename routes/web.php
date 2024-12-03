<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ContactController;
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

// Start Backend Routes// 
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
        Route::get('/About', [AboutController::class, 'index'])->name('admin.about');
    });
});
// End Backend Routes// 



// Start Front End // 
Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('contact-us', [ContactController::class, 'index'])->name('contact-us');
    // Lang routes

    Route::get('/lang/{locale}', [LanguageController::class, 'switchLocale'])->name('lang');
});
// End Frontend // 
