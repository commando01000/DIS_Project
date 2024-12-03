<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ContactController;


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

use App\Http\Controllers\LanguageController;

Route::get('/lang/{locale}', [LanguageController::class, 'switchLocale'])->name('lang');

Route::prefix('admin')->group(function () {

    Route::get('admin/change-password', [AdminController::class, 'showPasswordForm'])->name('admin.password');
    Route::post('admin/password', [AdminController::class, 'updatePassword'])->name('admin.update.password');

    // Show login form
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');

    // Handle login
    Route::post('/login', [AdminAuthController::class, 'login']);

    // Protected routes (only accessible to logged-in admins)
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

        // Logout route
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
    // Route to show the change password and email form
    Route::get('password', [AdminController::class, 'showPasswordForm'])->name('admin.password');

    // Route to handle the form submission
    Route::post('password', [AdminController::class, 'updatePassword'])->name('admin.update.password');
});


Route::prefix('/')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('contact-us', [ContactController::class, 'index'])->name('contact-us');
    // Lang routes
});